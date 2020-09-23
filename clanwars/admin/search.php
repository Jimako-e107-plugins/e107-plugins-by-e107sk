<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin_old\.php\?Search/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?Search/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$q = $_GET['q'];

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/


$items = array();
if($_GET['type'] == 'opp_tag'){
	 $result = e107::getDb()->retrieve("clan_wars", "opp_tag", "GROUP BY opp_tag ORDER BY opp_tag", true);
	 foreach($result as $row){
			$items[$row['opp_tag']] = $row['opp_tag'];
		}		
}elseif($_GET['type'] == 'opp_name'){
	 $result = e107::getDb()->retrieve("clan_wars", "opp_name", "GROUP BY opp_name ORDER BY opp_name", true);
	 foreach($result as $row){
			$items[$row['opp_name']] = $row['opp_name'];
		}		
}elseif($_GET['type'] == 'opp_url'){
	   $result = e107::getDb()->retrieve("clan_wars", "opp_url", "GROUP BY opp_url ORDER BY opp_url", true);
		foreach($result as $row){
			$items[$row['opp_url']] = $row['opp_url'];
		}		
}elseif($_GET['type'] == 'style'){
    $result = e107::getDb()->retrieve("clan_wars", "style", "GROUP BY style ORDER BY style", true);
		foreach($result as $row){
			$items[$row['style']] = $row['style'];
		}		
}elseif($_GET['type'] == 'mapname'){
	$gid = intval($_GET['gid']);
	$result = e107::getDb()->retrieve("clan_wars_maps", "name", ($gid > 0?"WHERE gid='$gid' ":"")."GROUP BY name ORDER BY name", true);
		foreach($result as $row){
			$items[$row['name']] = $row['name'];
		}		
}elseif($_GET['type'] == 'gametype'){
	$result = e107::getDb()->retrieve("clan_wars_maplink", "gametype", "GROUP BY gametype ORDER BY gametype", true);
		foreach($result as $row){
			$items[$row['gametype']] = $row['gametype'];
		}		
}elseif($_GET['type'] == 'player'){
	$result = e107::getDb()->retrieve("clan_wars_lineup", "member", "GROUP BY member ORDER BY member", true);
		foreach($result as $row){
			if(intval($row['member']) == 0)
			$items[$row['member']] = $row['member'];
		}
	$result = e107::getDb()->retrieve("user", "user_name", "ORDER BY user_name", true);
	  foreach($result as $row){
			$items[$row['user_name']] = $row['username'];
		}	
}elseif($_GET['type'] == 'userlist'){
	$result = e107::getDb()->retrieve("user", "user_name", "ORDER BY user_name", true);
		foreach($result as $row){
			$items[$row['user_name']] = $row['username'];
		}		
}
$q = str_replace(" ","",$q);
if($q !=""){
	foreach ($items as $key=>$value) {
		if (strpos(strtolower($key), $q) !== false) {
			echo "$key((keyvalsep))$value\n";
		}
	}
}
?>