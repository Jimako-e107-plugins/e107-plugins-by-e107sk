<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

function VisibleInfo($infoname){
	global $conf;
	$listorder = unserialize($conf['listorder']);
	$profileorder = unserialize($conf['profileorder']);
	if(in_array($infoname, $listorder['show']) or in_array($infoname, $profileorder['show'])){
		return true;
	}else{
		return false;
	}
}

function is_clanmember($uname){
	$sql = e107::getDB();
	if(intval($uname)>0){
		$rows = $sql->count("clan_members_info", "(*)", "WHERE userid='$uname'");
	}else{
		$rows = $sql->count("clan_members_info i, ".MPREFIX."user u", "(*)", "WHERE u.user_id=i.userid AND u.user_name='$uname'");
	}
	if($rows == 1){
		return true;
	}else{
		return false;
	}
}

function cm_getuserid($uname){
	$sql = e107::getDB();
	$userid = $sql->retrieve("user", "userid", "user_name='$uname'  LIMIT 1 ");
	return $userid;
}

function cm_getuser_name($userid){
	$sql = e107::getDB();
	$username = $sql->retrieve("user", "user_name", "user_id='$userid' LIMIT 1");
	return $username;
}

?>