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

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/

//Screens
$TrackDir=opendir("images/Screens");
	while ($file = readdir($TrackDir)) {  
		if(!in_array($file, array(".", "..", "index.php", ".htaccess", "thumbs"))){ 
			if(!$sql->count("clan_wars_screens", "(*)", "WHERE url='$file'")){
				if(file_exists("images/Screens/$file")){
					unlink("images/Screens/$file");
				}
			}
		} 
	}  	
closedir($TrackDir);

//thumbs
$TrackDir=opendir("images/Screens/thumbs");
	while ($file = readdir($TrackDir)) {  
		if(!in_array($file,array(".", "..", "index.php", ".htaccess"))){

			if(!$sql->count("clan_wars_screens", "(*)", "WHERE url='$file'")){
				if(file_exists("images/Screens/thumbs/$file")){
					unlink("images/Screens/thumbs/$file");
				}
			}
		} 
	}  	
closedir($TrackDir);

$sql1 = e107::getDB();
if($result = $sql->retrieve("clan_wars_lineup", "*", "", true)) {
  foreach($result as $clrow) {
		$clwid = $clrow['wid'];
		if($sql1->count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->delete("clan_wars_lineup", "wid='$clwid'");
		}
	}
}	
if($result = $sql->retrieve("clan_wars_maps", "*", "", true)) {
	foreach($result as $clrow) {
		$clwid = $clrow['wid'];
		if($sql1->count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->delete("clan_wars_maps", "wid='$clwid'");
		}
	}
}
if($result = $sql->retrieve("clan_wars_comments", "*", "", true)) {
	foreach($result as $clrow) {
		$clwid = $clrow['wid'];
		if($sql1->count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->delete("clan_wars_comments", "wid='$clwid'");
		}
	}
}

if($result = $sql->retrieve("clan_wars_screens", "*", "", true)) {
	foreach($result as $clrow) {
		$clwid = $clrow['wid'];
		if($sql1->count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->delete("clan_wars_screens", "wid='$clwid'");
		}
	}
}

$sql->update("clan_wars_config", "lastclean='".time()."'");
?>