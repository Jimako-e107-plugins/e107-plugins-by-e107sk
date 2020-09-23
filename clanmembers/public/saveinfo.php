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

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
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

$dd = intval($_POST['dd']);
$mm = intval($_POST['mm']);
$yyyy = intval($_POST['yyyy']);

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

$showage = intval($_POST['showage']);
$delete = intval($_POST['delete']);

$userid = USERID;
if($userid != $memberid or !is_clanmember($memberid)){
	header("Location: clanmembers.php");
	die();
}

if($delete == 1){
	e107::getDb()->update("clan_members_info", "avatar='' WHERE userid='$memberid'");	
}
$text = "";
if(isset($_FILES['newimage']) && $conf['allowupimage']) { 
	if($conf['maxfilesize'] == 0 || $_FILES['newimage']['size'] <= ($conf['maxfilesize'] * 1024)){
		//select filename and filesize
		$filename = $_FILES['newimage']['name']; 
		if($filename !=""){		
		
			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			$newimage = preg_replace("/[^a-zA-Z0-9\s]/", "", $member)."_".rand(1000, 9999).".".$ext;		
			$newimage = str_replace(" ","_",$newimage);
			
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				$text = "<div class='text-center'><br />"._ONLYIMGSALLOWED."<br /><br /></div>";
			}else{	
				//upload the file 
				move_uploaded_file($_FILES['newimage']['tmp_name'], "images/UserImages/".$newimage);			
				//chmod the file so everyine can see it 
				chmod("images/UserImages/".$newimage, 0777); 
				e107::getDb()->update("clan_members_info", "avatar='$newimage' WHERE userid='$memberid'");
			}
		}
	}else{
		$text = "<div class='text-center'><br />"._IMGNOTUPLMAXSIZE.$conf['maxfilesize']."kB.<br /><br /></div>";
	}
}		
	$qry = "";
	if($conf['allowchangeinfo']){
		if($conf['enableprofile'] && $conf['enablehardware']){
			//Update Hardware		
			$qry .= "manufacturer='$manufacturer', cpu='$cpu', memory='$memory', hdd='$hdd', vga='$vga', monitor='$monitor', sound='$sound', speakers='$speakers', keyboard='$keyboard', mouse='$mouse', surface='$surface', os='$os', mainboard='$mainboard', pccase='$pccase', ";
		}
		
		if(VisibleInfo("Age") or VisibleInfo("Birthday")){
			if($showage){
			 	$birthday = mktime(0,0,0,$mm, $dd, $yyyy);
			}else{
				$birthday = 0;
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
			$qry .= "country='$country'";
		}
		
		if(substr($qry,-2) == ", "){
			$qry = substr($qry,0,-2);
		}
		e107::getDb()->update("clan_members_info", $qry." WHERE userid='$memberid'");
	}

if($conf['allowchangeinfo']){
	$text .= "<div class='text-center'><br />"._URINFOSAVED."<br /><br /></div>";
}else{
	if($text == "")
	$text = "<div class='text-center'><br />"._URIMGISUPDATED."<br /><br /></div>";
}

$ns->tablerender($conf['cmtitle'], $text);

header("refresh:1;url=clanmembers.php");

?>