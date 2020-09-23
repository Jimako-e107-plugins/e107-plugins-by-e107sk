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

//------------------------------------------------------------------------------------------------------------+

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

 
  //<link rel='stylesheet' href='lgsl_files/styles/<?php echo $lgsl_config['style'];  
  $lgsl_prefs= e107::pref('lgsl');
   
  if($lgsl_prefs['style']) {
       e107::css('lgsl', 'lgsl_files/styles/'.$lgsl_prefs['style']);
  }
  
  //in lgsl_config you can use e107 stuff because usebar.php 
  $lgsl_prefs['zone_grid'] = e107::unserialize($lgsl_prefs['zone_grid']);
  $lgsl_prefs['zone_players'] = e107::unserialize($lgsl_prefs['zone_players']);
  $lgsl_prefs['zone_random'] = e107::unserialize($lgsl_prefs['zone_random']);
  $lgsl_prefs['zone_hide_offline'] = e107::unserialize($lgsl_prefs['zone_hide_offline']);
  $lgsl_prefs['zone_title'] = e107::unserialize($lgsl_prefs['zone_title']);
  
  /* examples for theme customization
  $detail_icon = "<i class=\'fa fa-search\'></fa>";
  
  $('.details_icon').addClass('btn btn-primary');
  $('.details_icon').html('".$detail_icon."');
 */
 
 /* fix for darken + LZ2 images 
  .game_icon {
   position: absolute;
  }
  .details_cell > a {  position: absolute;
  }
  .contry_icon {
    position: absolute;
    right: 0;
  }
*/ 
  if($lgsl_prefs['bootstrap3_table']) {
     $start = "$(document).ready(function() {";
   	 $end   = "});	";
 
  	 $inline_script .= " 
        $('#server_list_table').addClass('table table-striped');
        $('#totals').addClass('row text-center');
        $('#totals div').addClass('col-sm-4 col-xs-12');      
        ";
  }              
  if($lgsl_prefs['bootstrap3_imagefix']) {
      $css .=  "
       .game_icon {
         position: absolute;
        }
        .details_cell > a {  position: absolute;
        }
        .contry_icon {
          position: absolute;
          right: 0;
        }
    ";  
  }
  e107::css('inline', $css); 
  e107::js('inline', $start.$inline_script.$end);
  require_once HEADERF;   
 
  global $output, $lgsl_server_id;
//------------------------------------------------------------------------------------------------------------+

  $output = "";
  $s = isset($_GET['s']) ? $_GET['s'] : "";
  
  if     (is_numeric($s)) { $lgsl_server_id = $s; require "lgsl_files/lgsl_details.php"; }
  elseif ($s == "add")    {                       require "lgsl_files/lgsl_add.php";     }
  else                    {                       require "lgsl_files/lgsl_list.php";    }
 

  $ns -> tablerender($lgsl_config['title'][0], $output);

  unset($output);

//------------------------------------------------------------------------------------------------------------+

  require_once FOOTERF;

//------------------------------------------------------------------------------------------------------------+

?>
