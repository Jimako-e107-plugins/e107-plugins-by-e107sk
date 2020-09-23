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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "details.php")) {
    die ("You can't access this file directly...");
}



/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/



$clanwars =  e107::getSingleton('clanwars', e_PLUGIN.'clanwars/clanwars.class.php');   
$clanwars->render();
 

$singlewar = e107::getSingleton('details', e_PLUGIN.'clanwars/public/details.class.php');
$singlewar->init();



$wid = $singlewar->getWarId();

//$result = 	$row =  $sql->retrieve("clan_wars", "*", "wid='$wid'");
$result = $singlewar->getWarData();
 
/* todo move to init */
if(!$result['wid']){
	$text = "<br /><br /><div class='text-center'>War not found.</div><br /><br />";
	$ns->tablerender(_CLANWARS, $text, 'clanwars');
	require_once(FOOTERF);
	exit;
}
 
/*	$wardate = $row['wardate'];
	$style = $row['style'];
	$team = $row['team'];
	$opp_tag = $row['opp_tag'];
	$opp_name = $row['opp_name'];
	$opp_url = $row['opp_url'];
	$opp_country = $row['opp_country'];
	$game = $row['game'];
	$players = $row['players'];
	$our_score = $row['our_score'];
	$opp_score = $row['opp_score'];
	$status = $row['status'];
	$serverip = $row['serverip'];
	$serverpass = $row['serverpass'];			
	$report = $row['report'];
	$report_url = $row['report_url'];
	$wholineup = $row['wholineup'];   */
	
	/* important, not remove this */
	extract($result);
?>
 
<script type="text/javascript">
var wid = "<?php echo $wid;?>";
var username = "<?php echo USERNAME;?>";
var usesubs = "<?php echo $conf['usesubs'];?>";
var players = "<?php echo $players;?>";
var is_admin = <?php echo ((ADMIN && getperms("P")) ? "true" : "false" ). ";\n";?>
var is_user = <?php echo ((USER) ? "true" : "false" ). ";\n";?>
var wars_jq = jQuery;
//LANG
var edittext = "<?php echo _WEDIT;?>";
var deltext = "<?php echo _WDEL;?>";
var savetext = "<?php echo _WSAVE;?>";
var canceltext = "<?php echo _WCANCEL;?>";
var suredelwar = "<?php echo _WSUREDELWAR;?>";
var errordelwar = "<?php echo _WERRORDELWAR;?>";
var writecomm = "<?php echo _WWRITECOMM;?>";
var loginfirstt = "<?php echo _WLOGINFIRSTT;?>";
var erroraddcomm = "<?php echo _WERRORADDCOMM;?>";
var suredelcomm = "<?php echo _WSUREDELCOMM;?>";
var errordelcomm = "<?php echo _WERRORDELCOMM;?>";
var suredelallcomm = "<?php echo _WSUREDELALLCOMM;?>";
var errordelcomms = "<?php echo _WERRORDELCOMMS;?>";
var errorsavecomm = "<?php echo _WERRORSAVECOMM;?>";
var erroraddlineup = "<?php echo _WERRORADDLINEUP;?>";
var errorremovelu = "<?php echo _WERRORREMOVELU;?>";
//END LANG

</script>
<script type="text/javascript" src="includes/details.js"></script>

<?php
	//cleaning lineups for this war, why here? 
	if($status == 0){
		e107::getDb()->update("clan_wars_lineup", "available='1' WHERE wid='$wid' AND available='2'");
	}else{
		e107::getDb()->update("clan_wars_lineup", "available='2' WHERE wid='$wid' AND available='1'");
		e107::getDb()->delete("clan_wars_lineup", "wid='$wid' AND available='0'");
	}
 
if (false) {
	$text .= "<div class='text-center'><br /><b>[</b>&nbsp;<b>"._WADMIN.":</b> <a href='admin_old.php?EditWar&wid=$wid'>"._WEDITWAR."</a>&nbsp;<b>|</b>&nbsp;<a href='javascript:DelWar($wid);'>"._WDELWAR."</a>&nbsp<b>]</b></div>";
}elseif(canaddwars() && $conf['caneditwar']){
		$text .= "<div class='text-center'><br /><b>[</b>&nbsp;<b>"._WWAROPS.":</b> <a href='clanwars.php?EditWar&wid=$wid'>"._WEDIT." War</a>&nbsp;<b>]</b></div>";

}

$ns->tablerender($title, $text);

?>