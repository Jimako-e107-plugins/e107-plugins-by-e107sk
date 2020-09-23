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

$memberid = intval($_POST['memberid']);
$member = $tp->toDB($_POST['member']);

$gender = $tp->toDB($_POST['gender']);
$xfire = $tp->toDB($_POST['xfire']);
$steam = $tp->toDB($_POST['steam']);
$realname = $tp->toDB($_POST['realname']);
$location = $tp->toDB($_POST['location']);
$country = $tp->toDB($_POST['country']);
$xactive = intval($_POST['xactive']);
$tryout = intval($_POST['tryout']);
$votedate = $tp->toDB($_POST['votedate']);
$rank = intval($_POST['rank']);
$memberrank = intval($_POST['memberrank']);

$dd = intval($_POST['dd']);
$mm = intval($_POST['mm']);
$yyyy = intval($_POST['yyyy']);
$joind = intval($_POST['joind']);
$joinm = intval($_POST['joinm']);
$joiny = intval($_POST['joiny']);

$manufacturer = $tp->toDB($_POST['manufacturer']);
$cpu = $tp->toDB($_POST['cpu']);
$memory = $tp->toDB($_POST['memory']);
$hdd = $tp->toDB($_POST['hdd']);
$vga = $tp->toDB($_POST['vga']);
$monitor = $tp->toDB($_POST['monitor']);
$sound = $tp->toDB($_POST['sound']);
$speakers = $tp->toDB($_POST['speakers']);
$keyboard = $tp->toDB($_POST['keyboard']);
$mouse = $tp->toDB($_POST['mouse']);
$surface = $tp->toDB($_POST['surface']);
$os = $tp->toDB($_POST['os']);
$mainboard = $tp->toDB($_POST['mainboard']);
$pccase = $tp->toDB($_POST['pccase']);

$showjoin = intval($_POST['showjoin']);
$showage = intval($_POST['showage']);
$delete = intval($_POST['delete']);

//$dot = explode("/",$votedate);
//$votedate = mktime(0,0,0,$dot[1],$dot[2],$dot[0]);

if($delete == 1){
	e107::getDB()->update("clan_members_info", "avatar='' WHERE userid='$memberid'");	
}
if(isset($_FILES['newimage'])) { 
	//select filename and filesize
	$filename = $_FILES['newimage']['name']; 
	if($filename !=""){		
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$newimage = preg_replace("/[^a-zA-Z0-9\s]/", "", $member)."_".rand(1000, 9999).".".$ext;		
		$newimage = str_replace(" ","_",$newimage);
		
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			echo"<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
		}else{	
			//upload the file 
			move_uploaded_file($_FILES['newimage']['tmp_name'], "images/UserImages/".$newimage);			
			//chmod the file so everyine can see it 
			chmod("images/UserImages/".$newimage, 0777); 
			e107::getDb()->update("clan_members_info", "avatar='$newimage' WHERE userid='$memberid'");
		}
	}
}		
	$qry = "";
	if($conf['enableprofile'] && $conf['enablehardware']){
		//Update Hardware		
		$qry .= "manufacturer='$manufacturer', cpu='$cpu', memory='$memory', hdd='$hdd', vga='$vga', monitor='$monitor', sound='$sound', speakers='$speakers', keyboard='$keyboard', mouse='$mouse', surface='$surface', os='$os', mainboard='$mainboard', pccase='$pccase', ";
	}
	
		if(VisibleInfo("Join Date")){
			if($showjoin){
			 	$joindate = mktime(0,0,0,$joinm, $joind, $joiny);
			}else{
				$joindate = 1;
			}					
			$qry .= "joindate='$joindate', ";
		}if(VisibleInfo("Age") or VisibleInfo("Birthday")){
			if($showage){
			 	$birthday = mktime(0,0,0,$mm, $dd, $yyyy);
			}else{
				$birthday = 1;
			}	
			$qry .= "birthday='$birthday', ";
		}if(VisibleInfo("Gender")){
			$qry .= "gender='$gender', ";
		}if(VisibleInfo("Xfire")){
			$qry .= "xfire='$xfire', ";
		}if(VisibleInfo("Steam ID")){
			$qry .= "steam='$steam', ";
		}if(VisibleInfo("Realname")){
			$qry .= "realname='$realname', ";
		}if(VisibleInfo("Location")){
			$qry .= "location='$location', ";
		}if(VisibleInfo("Country")){
			$qry .= "country='$country', ";
		}if(VisibleInfo("Activity")){      
			$qry .= "active='$xactive', ";
		}if(VisibleInfo("Rank") or VisibleInfo("Rank Image")){
			$qry .= "rank='$memberrank', ";
		}
    /*	
		}if($conf['rank_per_game'] == 0 && (VisibleInfo("Rank") or VisibleInfo("Rank Image"))){
			$qry .= "rank='$rank'";
		}	 */
    $qry .= "tryout='$tryout', votedate='$votedate', ";
		if(substr($qry,-2) == ", "){
			$qry = substr($qry,0,-2);
		}
		$updateres = e107::getDB()->update("clan_members_info", $qry." WHERE userid='$memberid'");
 
 
//Update Games Memberships
$games = $sql->retrieve("clan_games", "gid", '', true);	
	foreach( $games as $row){
	$gid = $row['gid'];
	
	if($_POST["game$gid"] == 1){			
		if($conf['rank_per_game'] == 1){
			$rank = $_POST["rank$gid"];
			if($conf['gamesorteams'] == "Teams"){
				$rank = 0;
			}
		}
			
		if(e107::getDB()->count("clan_members_gamelink", "(*)", "WHERE gid='$gid' AND userid='$memberid'") == 0){		
			e107::getDB()->insert("clan_members_gamelink", array("gid" => $gid, "userid" => $memberid, "rank" => $rank));
		}else{
			e107::getDB()->update("clan_members_gamelink", "rank='$rank' WHERE gid='$gid' AND userid='$memberid'");
		}			
	}else{
		e107::getDB()->delete("clan_members_gamelink", "gid='$gid' AND userid='$memberid'");
	}		
}

//Update Team Memberships
$teams = $sql->retrieve("clan_teams", "tid", '', true);
	foreach($teams as $row){
	$tid = $row['tid'];
	if($_POST["team$tid"] == 1){			
		if($conf['rank_per_game'] == 1){
			$rank = $_POST["rank$tid"];
			if($conf['gamesorteams'] == "Games"){
				$rank = 0;
			}
		}		
		if(e107::getDB()->count("clan_members_teamlink", "(*)", "WHERE tid='$tid' AND userid='$memberid'") == 0){		
			e107::getDB()->insert("clan_members_teamlink", array("tid" => $tid, "userid" => $memberid, "rank" => $rank));
		}else{
			e107::getDB()->update("clan_members_teamlink", "rank='$memberrank' WHERE tid='$tid' AND userid='$memberid'");
		}			
	}else{
		e107::getDB()->delete("clan_members_teamlink", "tid='$tid' AND userid='$memberid'");
	}	
   	
}

//Awards
if($awards = $sql->retrieve("clan_members_awardlink", "id", "userid='$memberid'", true)) {	
if($conf['showawards']){
 foreach($awards as $row){
		$id = $row['id'];
		if(intval($awards[$id]) == 0){
			e107::getDB()->delete("clan_members_awardlink", "id='$id' AND userid='$memberid'");
		}
	}
}
}

header("refresh:1;URL=admin_old.php");

$ns->tablerender(_CLANMEMBERS, "<center>"._INFOOF.$member._HASBEENUPDATED."</center>");


?>