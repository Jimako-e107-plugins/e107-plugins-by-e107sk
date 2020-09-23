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
if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if (!isset($pref['plug_installed']['clanwars']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/

include_lan(e_PLUGIN.'clanwars/languages/'.e_LANGUAGE.'/clanwars.php');
include_lan(e_PLUGIN.'clanwars/languages/'.e_LANGUAGE.'/clanwars_common.php');
                      
if (strstr(e_QUERY, "untrack"))
{
	$tmp1 = explode(".", e_QUERY);
	$tmp = str_replace("-".$tmp1[1]."-", "", USERREALM);
	$sql->update("user", "user_realm='".$tp -> toDB($tmp, true)."' WHERE user_id='".USERID."' ");
	header("location:".e_SELF."?track");
	exit;
}

$action = e_QUERY;
if($action == "") $action = "main";
$dot = explode("&", $action);
$action = $dot[0];
                      
$dontinc = array("AddWar", "AddComment", "SaveComment", "DelComment", "DelFromLineup", "AddToLineup", "Subscribe", "Unsubscribe", "DelScreen", "AddPlayer", "DelPlayer", "AddMap", "DelMap", "SaveMap", "Screens", "Upload", "CreateThumb", "Search", "GetInfo");
$incadmin = array("DelScreen", "AddPlayer", "DelPlayer", "AddMap", "DelMap", "SaveMap", "Screens", "Upload", "CreateThumb", "Search", "GetInfo");
  
/* SCRIPTS BEFORE CALLING HEADERS */

if(in_array($action, array('EditWar'))) {
e107::library('core', 'jquery-ui.js');  
e107::css('url', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
e107::js('footer', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');

e107::css('clanwars', 'includes/jquery.autocomplete.css');
e107::css('clanwars', 'includes/editwar.css');
e107::css('clanwars', 'includes/jquery.fancybox.css');
           
e107::js('footer', e_PLUGIN.'clanwars/includes/date.js', 'jquery'); 
e107::js('footer', e_PLUGIN.'clanwars/includes/jquery.autocomplete.js', 'jquery'); 
e107::js('footer', e_PLUGIN.'clanwars/includes/pubeditwar.js', 'jquery');
 
}

if(!in_array($action, $dontinc)) require_once(HEADERF);

//Load Config
$conf = $sql->retrieve("clan_wars_config", "*", " LIMIT 1");

//Include Functions
require_once(e_PLUGIN."clanwars/includes/functions.php");
              
//Clean up tables
if($clrows = $sql->retrieve("clan_wars", "*", "", true)){    

	foreach($clrows as $clrow) {
		$clwid = $clrow['wid'];     
		if($clrow['status']){
  		$sql->delete("clan_wars_lineup", "available='0' and wid='$clwid'");
      
      // UPDATE e107_clan_wars_lineup SET available='2' where wid='317' and available='1'
 		  $sql->update("clan_wars_lineup", "available='2' where available='1' and wid='$clwid' ");
		}else{     
			$sql->update("clan_wars_lineup", "available='1' where available='2' and wid='$clwid' "); 
		}    
	} 
}
  
$deltime = time()-(24*60*60);
$sql->delete("clan_wars_mail", "active='0' AND code!='' AND subscrtime<$deltime");
         
define('WARS_PUB', true);
if(canaddwars()) define('WARS_SPEC',true);
if(in_array($action, $incadmin)){
	$folder = "admin"; 
}else{
	$folder = "public";
}             
/* $incadmin
Array
(
    [0] => DelScreen
    [1] => AddPlayer
    [2] => DelPlayer
    [3] => AddMap
    [4] => DelMap
    [5] => SaveMap
    [6] => Screens
    [7] => Upload
    [8] => CreateThumb
    [9] => Search
    [10] => GetInfo
)
*/
if(file_exists(e_PLUGIN.'clanwars/'.$folder."/".strtolower($action).".php")) include(e_PLUGIN.'clanwars/'.$folder."/".strtolower($action).".php");

if(!in_array($action, $dontinc)) require_once(FOOTERF);
exit;        
?>