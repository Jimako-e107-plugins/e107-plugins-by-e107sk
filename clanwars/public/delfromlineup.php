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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "delfromlineup.php")) {
    die ("You can't access this file directly...");
}
$sql = e107::getDb();

$wid = intval($_GET['wid']);
$row = $sql->retrieve("clan_wars", "*", "wid='$wid'"); 

$team = $row['team'];
$game = $row['game'];
$wholineup = $row['wholineup'];
 		
if(canlineup(($wholineup == 1?$team:$game), $wholineup)){
	$result = $sql->delete("clan_wars_lineup", "wid='$wid' AND member='".USERID."'");
	if($result){
		print '1';
	}
}
 
		
?>