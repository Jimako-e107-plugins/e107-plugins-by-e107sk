<?php
require_once('../../class2.php');
require_once(CLAN_FORUM_FORUMCLASS);
	
$timestart = microtime();
$forum = new e107clanforum;
	
//for($i=1; $i<=7000; $i++) {
// $x = $forum->update_lastpost('thread',$i);
//}
	
set_time_limit(240);
$forum->update_lastpost(CLAN_FORUM_TABLE_NOPREFIX, 'all');
//$x = $forum->update_lastpost(CLAN_FORUM_TABLE_NOPREFIX,16);
	
	
$timeend = microtime();
$diff = number_format(((substr($timeend, 0, 9)) + (substr($timeend, -10)) - (substr($timestart, 0, 9)) - (substr($timestart, -10))), 4);
echo "<br />script generation took $diff s";
	
?>