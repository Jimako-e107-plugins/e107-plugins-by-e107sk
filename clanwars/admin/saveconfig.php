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

if (!defined('WARS_ADMIN') or !preg_match("/admin_old.php\?SaveConfig/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
 
 
/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
$frm = e107::getForm(); 
$tp = e107::getParser();
/******  REPLACE OLD GLOBALS END  *********************************************/

 
$rowsperpage = intval($_POST['rowsperpage']);
$format1 = $tp->toDB($_POST['format1']);
$format2 = $tp->toDB($_POST['format2']);
$format3 = $tp->toDB($_POST['format3']);
$formatlist = $tp->toDB($_POST['formatlist']);
$formatdetails = $tp->toDB($_POST['formatdetails']);
$formatblock = $tp->toDB($_POST['formatblock']);
$enablecomments = intval($_POST['enablecomments']);
$guestcomments = intval($_POST['guestcomments']);
$kbsize = intval($_POST['kbsize']);
$resizescreens = intval($_POST['resizescreens']);
$createthumbs = intval($_POST['createthumbs']);
$resizedwidth = intval($_POST['resizedwidth']);
$thumbwidth = intval($_POST['thumbwidth']);
$enablelineup = intval($_POST['enablelineup']);
$guestlineup = intval($_POST['guestlineup']);
$tablename = $tp->toDB($_POST['tablename']);
$fieldname = $tp->toDB($_POST['fieldname']);
$colorbox = intval($_POST['colorbox']);
$usesubs = intval($_POST['usesubs']);
$enablemail = intval($_POST['enablemail']);
$allowsubscr = intval($_POST['allowsubscr']);
$emailact = intval($_POST['emailact']);
$sendmail = intval($_POST['sendmail']);
$seperate = intval($_POST['seperate']);
$showip = intval($_POST['showip']);
$stateserver = intval($_POST['stateserver']);
$statereport = intval($_POST['statereport']);
$statemaps = intval($_POST['statemaps']);
$statelineup = intval($_POST['statelineup']);
$statescreens = intval($_POST['statescreens']);
$statecomments = intval($_POST['statecomments']);
$showteamflag = intval($_POST['showteamflag']);
$warssummary = intval($_POST['warssummary']);
$newaddwarlist = $tp->toDB($_POST['newaddwarlist']);
$caneditwar = intval($_POST['caneditwar']);
$arrowcolor = $tp->toDB($_POST['arrowcolor']);
$screensperrow = intval($_POST['screensperrow']);
$scorepermap = intval($_POST['scorepermap']);
$autocalcscore = intval($_POST['autocalcscore']);
$mapmustmatch = intval($_POST['mapmustmatch']);
//$mapwidth = intval($_POST['mapwidth']);
$mapwidth = $tp->toDB($_POST['mapwidth']);
$requireapproval = intval($_POST['requireapproval']);
$mapsperrow = intval($_POST['mapsperrow']);

	$scrbytesize = $kbsize * 1024;
	$dateformat = "$format1/$format2/$format3";
	if($screensperrow < 1){$screensperrow=2;}
	
	$sql->update("clan_wars_config", "rowsperpage='$rowsperpage', dateformat='$dateformat', formatlist='$formatlist', formatdetails='$formatdetails', formatblock='$formatblock', enablecomments='$enablecomments', guestcomments='$guestcomments', screenmaxsize='$scrbytesize', resizescreens='$resizescreens', createthumbs='$createthumbs', resizedwidth='$resizedwidth', thumbwidth='$thumbwidth', enablelineup='$enablelineup', guestlineup='$guestlineup', tablename='$tablename', fieldname='$fieldname', colorbox='$colorbox', usesubs='$usesubs', enablemail='$enablemail', allowsubscr='$allowsubscr', emailact='$emailact', sendmail='$sendmail', seperate='$seperate', showip='$showip', stateserver='$stateserver', statereport='$statereport', statemaps='$statemaps', statelineup='$statelineup', statescreens='$statescreens', statecomments='$statecomments', showteamflag='$showteamflag', warssummary='$warssummary', addwarlist='$newaddwarlist', caneditwar='$caneditwar', arrowcolor='$arrowcolor', screensperrow='$screensperrow', scorepermap='$scorepermap', autocalcscore='$autocalcscore', mapmustmatch='$mapmustmatch', mapwidth='$mapwidth', requireapproval='$requireapproval', mapsperrow='$mapsperrow'");

	$ns->tablerender(_CLANWARS, "<div class='text-center'> "._WCONFIGSUC."</div>");
	
	header("Refresh:1;URL=admin_old.php?Config");
	
	
	
?>