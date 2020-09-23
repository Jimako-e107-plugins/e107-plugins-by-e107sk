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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin_old\.php\?GetInfo/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?GetInfo/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/

$tp = e107::getParser();
$param = $tp->toDB($_GET['param']);
if($_GET['type'] == 'tag'){
	$row = $sql->retrieve("clan_wars", "opp_name, opp_url, opp_country", "opp_tag='$param' ORDER BY wid DESC LIMIT 1");
	echo $row['opp_name']."((oppinfseperator))".$row['opp_url']."((oppinfseperator))".$row['opp_country'];
}elseif($_GET['type'] == 'name'){
	$row = $sql->retrieve("clan_wars", "opp_tag, opp_url, opp_country", "opp_name='$param' ORDER BY wid DESC LIMIT 1");	
	echo $row['opp_tag']."((oppinfseperator))".$row['opp_url']."((oppinfseperator))".$row['opp_country'];
}
	
?>