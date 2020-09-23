<?php    
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 LGSL Plugin credits: Richard Perry (www.greycube.com) + tltneon (https://github.com/tltneon)
 *
 * #######################################
 * #     e107 website system plugin      #
 * #     by Jimako                    	 #
 * #     https://www.e107sk.com          #
 * #######################################
 */ 

if (!defined('e107_INIT')) { exit; }

global $lgsl_config, $lgsl_zone_number, $lgsl_prefs;

$lgsl_prefs= e107::pref('lgsl');
//in lgsl_config you can use e107 stuff because usebar.php 
$lgsl_prefs['zone_grid'] = e107::unserialize($lgsl_prefs['zone_grid']);
$lgsl_prefs['zone_players'] = e107::unserialize($lgsl_prefs['zone_players']);
$lgsl_prefs['zone_random'] = e107::unserialize($lgsl_prefs['zone_random']);
$lgsl_prefs['zone_hide_offline'] = e107::unserialize($lgsl_prefs['zone_hide_offline']);
$lgsl_prefs['zone_title'] = e107::unserialize($lgsl_prefs['zone_title']);
// you can't use e_LANGUAGE directly because userbar.php file
$lgsl_prefs['e107_language'] = e_LANGUAGE;
$lgsl_config['e107_language'] = e_LANGUAGE; 
if(!empty($parm['lgsl_menu_title'][e_LANGUAGE]))
{                                        
	$caption = $parm['lgsl_menu_title'][e_LANGUAGE];
}
else $caption = $lgsl_config['title'][$lgsl_zone_number]; 
 
$lgsl_zone_number =  e107::getParser()->toHTML($parm['lgsl_zone_number']);

$output = "";
require e_PLUGIN."lgsl/lgsl_files/lgsl_zone.php";
 
$styleid =  $parm['block_tablestyle']; 
        
$s = $parm['block_style'];     
                        
if(is_string($s) && strlen($s) > 0) {
   e107::getRender()->setStyle($s);
}        
                                    
e107::getRender()->tablerender($caption, $output,  $styleid  ) ;

 
?>