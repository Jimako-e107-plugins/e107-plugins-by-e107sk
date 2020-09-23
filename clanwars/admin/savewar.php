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

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php\?SaveWar/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
$tp = e107::getParser();
/******  REPLACE OLD GLOBALS END  *********************************************/

	$wid = intval($_POST["wid"]);
	$new = intval($_POST["new"]);
	
	$wardate = $tp->toDB($_POST["wardate"]);
	$wartime = $tp->toDB($_POST["wartime"]);	
	
	$status = intval($_POST['status']);
	$game = intval($_POST['game']);
	$team = intval($_POST['team']);
	$opp_tag = $tp->toDB($_POST['opp_tag']);
	$opp_name = $tp->toDB($_POST['opp_name']);
	$opp_url = $tp->toDB($_POST['opp_url']);
	$opp_country = $tp->toDB($_POST['opp_country']);
	$style = $tp->toDB($_POST['style']);
	$players = intval($_POST['players']);
	$our_score = intval($_POST['our_score']);
	$opp_score = intval($_POST['opp_score']);
	$serverip = $tp->toDB($_POST['serverip']);
	$serverpass = $tp->toDB($_POST['serverpass']);
	$wreport = $tp->toDB($_POST['wreport']);
	$report_url = $tp->toDB($_POST['report_url']);
	$wholineup = intval($_POST['wholineup']);
	
	if($conf['autocalcscore']){
		$row['totalscore'] =  $sql->retrieve("clan_wars_maplink", "SUM(our_score) as totalscore", "wid='$wid' LIMIT 1");
		$our = $row['totalscore'];
		$row['totalscore'] =  $sql->retrieve("clan_wars_maplink", "SUM(opp_score) as totalscore", "wid='$wid' LIMIT 1"); 
		$opp = $row['totalscore'];
			
		if($our > 0 or $opp > 0){
			$our_score = $our;
			$opp_score = $opp;
		}
	}
	if($wardate == ""){
		$newdate = -1;
	}else{			
	/*	$dot = explode(":",$wartime);
		$hour = intval($dot[0]);
		$min = intval($dot[1]);
		
		$exp1 = explode("/",$conf['dateformat']);
		$exp2 = explode("/",$wardate);
		$dates = array();
		for($i=0;$i<=2;$i++){
			$dates[$exp1[$i]] = intval($exp2[$i]);
		}
		
		$newdate = mktime($hour, $min, 0, $dates['mm'], $dates['dd'], $dates['yyyy']); */
    $newdate = $wardate;
	}
	
	//E-Mail Function
	if($conf['enablemail']){
		$sendemail = $_POST["sendemail"];
		if($sendemail == 1){
			if($result = $sql->retrieve("clan_wars_mail", "*", "active='1'", true)) {
				foreach($result as $row) {
					$email = $row['email'];
					$emaillist .= ",".$row['email'];
				}
				$emaillist = substr($emaillist, 1);
      }
			if($emaillist !=""){
				if($opp_name == ""){
					$opponent = $opp_tag;
				}else{
					$opponent = $opp_name;
				}
					
				if($style !=""){
					$stylemail = _WSTYLE.": $style\n";
				}
					
				if($players > 0){
					$playersmail = _WPLAYERS.": ".$players."on".$players."\n"; 
				}
					
				$gname = $sql->retrieve("clan_wars_games", "gname", "gid='$game' LIMIT 1");
				$maplist = "";
			 
				if($result = $sql->retrieve("clan_wars_maplink", "*", "wid='$wid'", true)) {
					foreach($result as $row) {
						$mapname = $row['mapname'];
						$gametype = $row['gametype'];
						if(intval($mapname) > 0){
							$mapname = $sql->retrieve("clan_wars_maps", "name", "mid='$mapname' LIMIT 1");
						}
						$maplist .= "$mapname $gametype\n";
					}
        }
				if($maplist !=""){
					$mapsmail = _WMAPLIST.":\n$maplist\n";
				}
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://".dirname($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
				$message = _WDATE.": ".date($conf['formatdetails'], $newdate)."\n"
						  ._WGAME.": $gname\n"
						  .$stylemail
						  .$playersmail
						  ."\n"._WOPP.": $opponent\n"
						  ._WCOUNTRY.": $opp_country\n"
						  ."\n"
						  .$mapsmail
						  ._WLINK.": $pageURL/clanwars.php?Details&wid=$wid";
				$fromaddress = "wars@".str_replace(array("http://", "https://", "www"), array("","",""), SITEURLBASE);
				$headers = "From: ".SITENAME." <".$fromaddress.">"
				. "\r\n" 
				. 'X-Mailer: PHP/' . phpversion();	
				
				mail($emaillist, (($status) ? _WFINWAR."!" : _WUPCWAR."!"), $message, $headers);
			}
		}			
	}
	//End Mail
		
	//Update database	
	$opp_url = str_replace('http://', '', $opp_url);
	$report_url = str_replace('http://', '', $report_url);
	$result = $sql->update("clan_wars", "status='$status', game='$game', wardate='$newdate', team='$team', opp_tag='$opp_tag', opp_name='$opp_name', opp_url='$opp_url', opp_country='$opp_country', style='$style', players='$players', our_score='$our_score', opp_score='$opp_score', serverip='$serverip', serverpass='$serverpass', report='$wreport', report_url='$report_url', wholineup='$wholineup', active='1' WHERE wid='$wid'");
	if($new){
		$text = "<div class='text-center'><br />"._WWARSHASBEENADDED."<br /><br /></div>";
	}else{
		$text = "<div class='text-center'><br />"._WWARUDATED."<br /><br /></div>";
	}
	$ns->tablerender(_CLANWARS, $text);
	header("Refresh:1;URL=admin_old.php");
	
?>