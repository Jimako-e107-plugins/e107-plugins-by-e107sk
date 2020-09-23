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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
$tp = e107::getParser();
/******  REPLACE OLD GLOBALS END  *********************************************/

$rank = $tp->toDB($_POST['rank']);
$rankimage = $tp->toDB($_POST['rimage']);

$text = "";
 
$row = $sql->retrieve("clan_members_ranks", "*", "ORDER BY rankorder DESC LIMIT 1" );
$order = $row['rankorder'] + 1;

$result = $sql->insert("clan_members_ranks", array("rank" => $rank, "rimage" => $rankimage, "rankorder" => $order));
 
	if($result){
		$text .= "<center><meta http-equiv='refresh' content='1;URL=admin_old.php?Ranks' />
		<br />"._RANKADDED."<br /><br />";
	}else{
		$text .= "<center><br />".ERRORUPDATINGDB."<br /><br />";
	}

$ns->tablerender(_CLANMEMBERS, $text);		
?>