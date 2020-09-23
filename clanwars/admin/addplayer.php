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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin_old\.php\?AddPlayer/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?AddPlayer/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

/******  REPLACE OLD GLOBALS  *************************************************/
 
$tp = e107::getParser();
/******  REPLACE OLD GLOBALS END  *********************************************/

$wid = intval($_GET['wid']);
$avail = intval($_GET['avail']);
$warstatus = intval($_GET['warstatus']);
$playername = $tp->toDB($_GET['playername']);
 
if(cw_getuser_id($playername)>0) $playername = cw_getuser_id($playername);
 
if($playername !="" && $wid > 0){
  $row = $sql->retrieve("clan_wars_lineup", "pid, available", "wid='$wid' and member='$playername' LIMIT 1 " );
 // echo $row['pid'];
	if($row['pid'] > 0 ){      
		if($warstatus == 1){
 
			if($row['available'] == 0){
				$result = e107::getDB()->update("clan_wars_lineup", "available='2' WHERE pid='".$row['pid']."'");		
				if($result){
					echo "updated".$row['pid'];
				}
			}
		}else{			
			echo "inlineup";
		}
	}else{		    
		$result =  e107::getDB()->insert("clan_wars_lineup", array("member" => $playername, "wid" => $wid, "available" => $avail));		
		echo $result;
	}
}
exit;
?>