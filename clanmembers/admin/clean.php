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
/******  REPLACE OLD GLOBALS END  *********************************************/

$sql1 = e107::getDb();
$sql->select("clan_members_config", "lastclean");
$row = $sql->fetch();
$lastclean = $row['lastclean'];
if($lastclean < time() - 24*60*60){
	e107::getDB()->update("clan_members_config", "lastclean='".time()."'");
	
	//Clean Files	
	//Awards
	$TrackDir=opendir("images/Awards");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDB()->count("clan_members_awards", "(*)", "WHERE image='$file'") == 0){
				if(file_exists("images/Awards/$file")){
					unlink("images/Awards/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//Ranks
	$TrackDir=opendir("images/Ranks");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDb()->count("clan_members_ranks", "(*)", "WHERE rimage='$file'") == 0){
				if(file_exists("images/Ranks/$file")){
					unlink("images/Ranks/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//Games
	$TrackDir=opendir("images/Games");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDB()->count("clan_games", "(*)", "WHERE banner='$file' or icon='$file'") == 0){
				if(file_exists("images/Games/$file")){
					unlink("images/Games/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//Teams
	$TrackDir=opendir("images/Teams");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDb()->count("clan_teams", "(*)", "WHERE banner='$file' or icon='$file'") == 0){
				if(file_exists("images/Teams/$file")){
					unlink("images/Teams/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//UserImages
	$TrackDir=opendir("images/UserImages");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDb()->count("clan_members_info", "(*)", "WHERE avatar='$file'") == 0){
				if(file_exists("images/UserImages/$file")){
					unlink("images/UserImages/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//Gallery
	$TrackDir=opendir("images/Gallery");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if(e107::getDB()->count("clan_members_gallery", "(*)", "WHERE url='$file'") == 0){
				if(file_exists("images/Gallery/$file")){
					unlink("images/Gallery/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	
	//Check Awards
	$sql1->select("clan_members_awardlink", "award");
		while($row = $sql->fetch()){
			if(e107::getDb()->count("clan_members_awards", "(*)", "WHERE rid='".$row['award']."'") == 0){
				e107::getDb()->delete("clan_members_awardlink", "award='".$row['award']."'");
			}
		}
	
	//Check Gallery
	$sql->select("clan_members_gallery", "userid");
		while($row = $sql->fetch()){
			if(e107::getDb()->count("clan_members_info", "(*)", "WHERE userid='".$row['userid']."'") == 0){
				e107::getDb()->delete("clan_members_gallery", "userid='".$row['userid']."'");
			}
		}
}
	
	
	
//Check members_member table
if($result = $sql->retrieve("clan_members_gamelink", "*", "", true)) {
foreach($result as $row) {
		$match = e107::getDb()->count("clan_members_info", "(*)", "WHERE userid='".$row['userid']."'");
		if($match == 0){
			e107::getDb()->delete("clan_members_gamelink", "id='".$row['id']."'");
		}
	}	
}	

//Check members_teamlink table
if($result = $sql->retrieve("clan_members_teamlink", "*", "", true)) {
	foreach($result as $row) {
		$match = e107::getDb()->count("clan_members_info", "(*)", "WHERE userid='".$row['userid']."'");
		if($match == 0){
			e107::getDb()->delete("clan_members_teamlink", "id='".$row['id']."'");
		}		
	}
}
		
?>