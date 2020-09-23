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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "addtolineup.php")) {
    die ("You can't access this file directly...");
}

$sql = e107::getDb();

$wid = intval($_GET['wid']);
$avail = intval($_GET['avail']);

$row =  $sql->retrieve("clan_wars", "*", "wid='$wid'");
 
	$team = $row['team'];
	$game = $row['game'];
	$wholineup = $row['wholineup'];

if(canlineup(($wholineup == 1?$team:$game), $wholineup)){
	$result = $sql->insert("clan_wars_lineup", array("member" => USERID, "wid" => $wid, "available" => $avail) );
	
	if($result){
		print '1';
	}
}

?>