<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/forum/forum_mod.php $
|     $Revision: 11741 $
|     $Id: forum_mod.php 11741 2010-09-04 08:32:42Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(CLAN_FORUM_LANGUAGES.'lan_forum_admin.php');

function forum_thread_moderate($p)
{
	global $sql;
	foreach($p as $key => $val) {
		if (preg_match("#(.*?)_(\d+)_x#", $key, $matches))
		{
			$act = $matches[1];
			$id = intval($matches[2]);

			switch($act)
			{
				case 'lock' :
				$sql->db_Update(CLAN_FORUM_THREAD_NOPREFIX, "thread_active=0 WHERE thread_id={$id}");
				return FORLAN_CLOSE;
				break;

				case 'unlock' :
				$sql->db_Update(CLAN_FORUM_THREAD_NOPREFIX, "thread_active=1 WHERE thread_id={$id}");
				return FORLAN_OPEN;
				break;

				case 'stick' :
				$sql->db_Update(CLAN_FORUM_THREAD_NOPREFIX, "thread_s=1 WHERE thread_id={$id}");
				return FORLAN_STICK;
				break;

				case 'unstick' :
				$sql->db_Update(CLAN_FORUM_THREAD_NOPREFIX, "thread_s=0 WHERE thread_id={$id}");
				return FORLAN_UNSTICK;
				break;

				case 'delete' :
				return forum_delete_thread($id);
				break;

			}
		}
	}
}

function forum_delete_thread($thread_id)
{
	global  $e_event;
  $sql = e107::getDb();
  
	$thread_id = (int)$thread_id;
	require_once(CLAN_FORUM_FORUMCLASS);
	$f = new e107clanforum;
	$qry = "
	SELECT t.thread_forum_id, t.thread_parent, t.thread_user, t.thread_thread, t.thread_name, f.forum_sub, f.forum_name
	FROM ".CLAN_FORUM_THREAD." AS t
	LEFT JOIN ".CLAN_FORUM_TABLE." AS f ON t.thread_forum_id = f.forum_id
	WHERE t.thread_id = ".$thread_id;
//	$sql->db_Select(CLAN_FORUM_THREAD_NOPREFIX, "*", "thread_id=".(int)$thread_id);

	if($sql->db_Select_gen($qry))
	{
		$ret = "";
		$row = $sql->fetch();
		if ($row['thread_parent'])
		{
			// post is a reply?
			$sql->delete(CLAN_FORUM_THREAD_NOPREFIX, "thread_id=".$thread_id);
			// dec forum reply count by 1
			$sql->db_Update(CLAN_FORUM_TABLE_NOPREFIX, "forum_replies=forum_replies-1 WHERE forum_id={$row['thread_forum_id']} AND forum_replies>0");
			// dec thread reply count by 1
			$sql->db_Update(CLAN_FORUM_THREAD_NOPREFIX, "thread_total_replies=thread_total_replies-1 WHERE thread_id={$row['thread_parent']} AND thread_total_replies>0");
			// dec user forum post count by 1
			$tmp = explode(".", $row['thread_user']);
			$uid = intval($tmp[0]);
			if($uid > 0)
			{
				$sql->db_Update("user", "user_forums=user_forums-1 WHERE user_id='".$uid."' AND user_forums>0");
			}
			// update lastpost info
			$f->update_lastpost('thread', $row['thread_parent']);
			$f->update_lastpost(CLAN_FORUM_TABLE_NOPREFIX, $row['thread_forum_id']);
			
			// fire event 'forumpostdelete'
			$edata_fo = array(
				"post"				=> $row['thread_thread'],
				"poster"			=> (intval($tmp[0]) ? $tmp[1] : "Anonymous"),
				"forum_name"	=> $row['forum_name'],
				"deleter"			=> USERNAME);
			$e_event -> trigger("forumpostdelete", $edata_fo);
			
			$ret = FORLAN_154;
		}
		else
		{
			// post is thread
			// delete poll if there is one
			$sql->db_Delete("poll", "poll_datestamp=".$thread_id);
			//decrement user post counts
			forum_userpost_count("WHERE thread_id = ".$thread_id." OR thread_parent = ".$thread_id, "dec");
			// delete replies and grab how many there were
			$count = $sql->db_Delete(CLAN_FORUM_THREAD_NOPREFIX, "thread_parent=".$thread_id);
			// delete the post itself
			$sql->db_Delete(CLAN_FORUM_THREAD_NOPREFIX, "thread_id=".$thread_id);
			// update thread/reply counts
			$sql->db_Update(CLAN_FORUM_TABLE_NOPREFIX, "forum_threads = CAST(GREATEST(CAST(forum_threads AS SIGNED) - 1, 0) AS UNSIGNED), forum_replies = CAST(GREATEST(CAST(forum_replies AS SIGNED) - {$count}, 0) AS UNSIGNED) WHERE forum_id=".$row['thread_forum_id']);

			// update lastpost info
			$f->update_lastpost(CLAN_FORUM_TABLE_NOPREFIX, $row['thread_forum_id']);
			
			// fire event 'forumthreaddelete'
			$tmp = explode(".", $row['thread_user']);
			$edata_fo = array(
				"subject"			=> $row['thread_name'],
				"post"				=> $row['thread_thread'],
				"poster"			=> (intval($tmp[0]) ? $tmp[1] : "Anonymous"),
				"forum_name"	=> $row['forum_name'],
				"deleter"			=> USERNAME);
			$e_event -> trigger("forumthreaddelete", $edata_fo);

			$ret = FORLAN_6.($count ? ", ".$count." ".FORLAN_7."." : ".");
		}

		//If parent forum is a sub, we must update lastpost info of it's parent
		if($row['forum_sub'])
		{
			//Update just the parent itself, if it's a container it will empty everything
			$f->update_lastpost(CLAN_FORUM_TABLE_NOPREFIX, $row['forum_sub']);
			//Update the parent with last post of either itself or it's subs
			$f->update_subparent_lp($row['forum_sub']);
		}
		return $ret;
	}
}

function forum_userpost_count($where = "", $type = "dec")
{
	global $sql;

	$qry = "
	SELECT thread_user, count(thread_user) AS cnt FROM ".CLAN_FORUM_THREAD."
	{$where}
	GROUP BY thread_user
	";

	if($sql->db_Select_gen($qry))
	{
		$uList = $sql->db_getList();
		foreach($uList as $u)
		{
			$tmp = explode(".", $u['thread_user']);
			$uid = intval($tmp[0]);
			if($uid > 0)
			{
				if("set" == $type)
				{
					$sql->db_Update("user", "user_forums={$u['cnt']} WHERE user_id=".$uid);
				}
				else
				{	// user_forums is unsigned, so underflow will give a very big number
					$sql->db_Update("user", "user_forums = CAST(GREATEST(CAST(user_forums AS SIGNED) - {$u['cnt']}, 0) AS UNSIGNED) WHERE user_id=".$uid);
				}
			}
		}
	}
}
