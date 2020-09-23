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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin_old\.php\?SaveMap/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?SaveMap/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$mid = intval($_POST['mid']);
$gid = intval($_REQUEST['gid']);
$lid = intval($_GET['lid']);
$tp = e107::getParser();
$mapname = $tp->toDB($_REQUEST['mapname']);

if($mid > 0 && $gid > 0){
	
	require_once(e_ADMIN.'auth.php');
	if(intval($_POST['delimage']) == 1){
		e107::getDb()->update("clan_wars_maps", "image='' WHERE mid='$mid'");	
	}	
	//Check if theres a file selected
	if(isset($_FILES['mapimage'])) {	
		//check is there a new name given
		$filename = $_FILES['mapimage']['name']; 
		if($filename !=""){
			$row = e107::getDb()->retrieve("clan_games", "abbr, gname", "gid='$gid' LIMIT 1");
			$abbr = $row['abbr'];
			$gname = $row['gname'];

			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			$image = preg_replace("/[^a-zA-Z0-9\s-_]/", "", ($abbr?$abbr:$gname)."-".$mapname)."-".rand(100, 999).".".$ext;
			$image = str_replace(" ", "_", $image);
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				$text = "<div class='text-center'><br />"._WONLYTYPESALLOWED."<br /><br /></div>";
			}else{		
				//upload the file 
				move_uploaded_file($_FILES['mapimage']['tmp_name'], "images/Maps/$image"); 
				chmod("images/Maps/$image", 0777);			
				e107::getDb()->update("clan_wars_maps", "image='$image' WHERE mid='$mid'");	
			}
		}
	}
	if($mapname !=""){
		$result = e107::getDb()->update("clan_wars_maps", "name='$mapname' WHERE mid='$mid'");
		$text .= "<div class='text-center'><br />The map has been updated<br /><br /></div>";
		header("Refresh:1;url=admin_old.php?ManageMaps&gid=$gid");		
	}else{
		$text .= "<div class='text-center'><br />"._WFILLINNAME."<br /><br /></div>";
		header("Refresh:2;url=admin_old.php?ManageMaps&gid=$gid");
	}
		
	$ns->tablerender(_CLANWARS, $text);
	require_once(e_ADMIN.'footer.php');
	exit;	
}elseif($lid > 0 ){
	if($mapname !=""){
		$gametype = $tp->toDB($_GET['gametype']);
		$our_score = intval($_GET['our_score']);
		$opp_score = intval($_GET['opp_score']);
		
		$row['mid']= e107::getDb()->retrieve("clan_wars_maps", "mid", "name='$mapname' AND gid='$gid' LIMIT 1");
 
		if(intval($row['mid']) > 0){ 
			$mid = $row['mid'];
		}else{
			$mid = e107::getDb()->insert("clan_wars_maps", array("gid" => $gid, "name" => $mapname));
		}
		$result = e107::getDb()->update("clan_wars_maplink", "mapname='$mid', gametype='$gametype', our_score='$our_score', opp_score='$opp_score' WHERE lid='$lid'");
		print '1';		
	}
}
		
?>