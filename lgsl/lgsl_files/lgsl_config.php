<?php

//------------------------------------------------------------------------------------------------------------+
//[ PREPARE CONFIG - DO NOT CHANGE OR MOVE THIS ]

  global $lgsl_config, $lgsl_prefs; 

 
//------------------------------------------------------------------------------------------------------------+
//[ FEED: 0=OFF 1=CURL OR FSOCKOPEN 2=FSOCKOPEN ONLY / LEAVE THE URL ALONE UNLESS YOU KNOW WHAT YOUR DOING ]

  $lgsl_config['feed']['method'] = 0;
  $lgsl_config['feed']['url']    = "http://www.greycube.co.uk/lgsl/feed/lgsl_files/lgsl_feed.php";

//------------------------------------------------------------------------------------------------------------+
//[ BACKGROUND COLORS: TEXT HARD TO READ ? CHANGE THESE TO CONTRAST THE FONT COLOR / www.colorpicker.com ]

  $lgsl_config['style'] = "darken_style.css"; // options: breeze_style.css, darken_style.css, classic_style.css, ogp_style.css, parallax_style.css, disc_ff_style.css, material_style.css
  $lgsl_config['scripts'] = ['parallax.js'];

//------------------------------------------------------------------------------------------------------------+
//[ SHOW LOCATION FLAGS: 0=OFF 1=GEO-IP "GB"=MANUALLY SET COUNTRY CODE FOR SPEED ]

  $lgsl_config['locations'] = varset($lgsl_prefs['locations'], 0);
  
//------------------------------------------------------------------------------------------------------------+
//[ SHOW TOTAL SERVERS AND PLAYERS AT BOTTOM OF LIST: 0=OFF 1=ON ]

  $lgsl_config['list']['totals'] = varset($lgsl_prefs['list_totals'], 0);
  
//------------------------------------------------------------------------------------------------------------+
//[ SORTING OPTIONS ]

  $lgsl_config['sort']['servers'] = varset($lgsl_prefs['sort_servers_by'], "id");   // OPTIONS: id  type  zone  players  status
  $lgsl_config['sort']['players'] = varset($lgsl_prefs['sort_players'], "name");  // OPTIONS: name  score time

//------------------------------------------------------------------------------------------------------------+
//[ ZONE SIZING: HEIGHT OF PLAYER BOX DYNAMICALLY CHANGES WITH THE NUMBER OF PLAYERS ]

  $lgsl_config['zone']['width']     = varset($lgsl_prefs['zone_width'], "160"); // images will be cropped unless also resized to match
  $lgsl_config['zone']['line_size'] = varset($lgsl_prefs['zone_line_size'], "19");  // player box height is this number multiplied by player names
  $lgsl_config['zone']['height']    = varset($lgsl_prefs['zone_height'], "100"); // player box height limit
  
//------------------------------------------------------------------------------------------------------------+
//[ ZONE GRID: NUMBER=WIDTH OF GRID - INCREASE FOR HORIZONTAL ZONE STACKING ]     

  $zone_number = varset($lgsl_prefs['zone_numbers'],8);
 
  for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++) {
     $lgsl_config['grid'][$fieldkey] = varset($lgsl_prefs['zone_grid'][$fieldkey],1);
  }
    /*
    $lgsl_config['grid'][1] = 1; 
    $lgsl_config['grid'][2] = 1; 
    $lgsl_config['grid'][3] = 1; 
    $lgsl_config['grid'][4] = 1; 
    $lgsl_config['grid'][5] = 1; 
    $lgsl_config['grid'][6] = 1; 
    $lgsl_config['grid'][7] = 1; 
    $lgsl_config['grid'][8] = 1; 
    $lgsl_config['grid'][9] = 1;
    $lgsl_config['grid'][10] = 1;
    $lgsl_config['grid'][11] = 1;
    $lgsl_config['grid'][12] = 1; 
    */
 

//------------------------------------------------------------------------------------------------------------+
//[ ZONE SHOWS PLAYER NAMES: 0=HIDE 1=SHOW ]
 
  for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++) {
     $lgsl_config['players'][$fieldkey] = varset($lgsl_prefs['zone_players'][$fieldkey], 1);
  }
/*
  $lgsl_config['players'][1] = 1;
  $lgsl_config['players'][2] = 1;
  $lgsl_config['players'][3] = 1;
  $lgsl_config['players'][4] = 1;
  $lgsl_config['players'][5] = 1;
  $lgsl_config['players'][6] = 1;
  $lgsl_config['players'][7] = 1;
  $lgsl_config['players'][8] = 1;
      */
//------------------------------------------------------------------------------------------------------------+
//[ ZONE RANDOMISATION: NUMBER=MAX RANDOM SERVERS TO BE SHOWN ]
 
  for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++) {
     $lgsl_config['random'][$fieldkey] = varset($lgsl_prefs['zone_random'][$fieldkey], 1);
  }
  /*
  $lgsl_config['random'][0] = 0;
  $lgsl_config['random'][1] = 0;
  $lgsl_config['random'][2] = 0;
  $lgsl_config['random'][3] = 0;
  $lgsl_config['random'][4] = 0;
  $lgsl_config['random'][5] = 0;
  $lgsl_config['random'][6] = 0;
  $lgsl_config['random'][7] = 0;
  $lgsl_config['random'][8] = 0;
   */
//------------------------------------------------------------------------------------------------------------+
// [ HIDE OFFLINE SERVERS: 0=HIDE 1=SHOW
 
  for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++) {
     $lgsl_config['hide_offline'][$fieldkey] = varset($lgsl_prefs['zone_hide_offline'][$fieldkey], 1);
  }
  
   /*
  $lgsl_config['hide_offline'][0] = 0;
  $lgsl_config['hide_offline'][1] = 0;
  $lgsl_config['hide_offline'][2] = 0;
  $lgsl_config['hide_offline'][3] = 0;
  $lgsl_config['hide_offline'][4] = 0;
  $lgsl_config['hide_offline'][5] = 0;
  $lgsl_config['hide_offline'][6] = 0;
  $lgsl_config['hide_offline'][7] = 0;
  $lgsl_config['hide_offline'][8] = 0;
     */
//------------------------------------------------------------------------------------------------------------+
//[ e107 VERSION: TITLES - OTHER CAPTIONS ARE SET BY THE CMS ]

  
  
  for ($fieldkey = 0; $fieldkey <= $zone_number; $fieldkey++) {
     if($fieldkey == 0)  {
       $lgsl_config['title'][$fieldkey] = varset($lgsl_prefs['zone_title'][$fieldkey], "Game Servers");
     }
     else {
       $lgsl_config['title'][$fieldkey] = varset($lgsl_prefs['zone_title'][$fieldkey], "Game Server");
     }
     
  }
    /*
  $lgsl_config['title'][0] = "Game Servers";
  $lgsl_config['title'][1] = "Game Server";
  $lgsl_config['title'][2] = "Game Server";
  $lgsl_config['title'][3] = "Game Server";
  $lgsl_config['title'][4] = "Game Server";
  $lgsl_config['title'][5] = "Game Server";
  $lgsl_config['title'][6] = "Game Server";
  $lgsl_config['title'][7] = "Game Server";
  $lgsl_config['title'][8] = "Game Server";
     */
//------------------------------------------------------------------------------------------------------------+
//[ STAND-ALONE VERSION: LGSL ADMIN LOGON ]

  $lgsl_config['admin']['user'] = "lgsladmin";
  $lgsl_config['admin']['pass'] = "changeme";

//------------------------------------------------------------------------------------------------------------+
//[ DATABASE SETTINGS: FOR STAND-ALONE OR TO OVERRIDE CMS DEFAULTS ]

  $lgsl_config['db']['server'] = "localhost";
  $lgsl_config['db']['user']   = "root";
  $lgsl_config['db']['pass']   = "";
  $lgsl_config['db']['db']     = "lgsl";
  $lgsl_config['db']['table']  = "lgsl";

//------------------------------------------------------------------------------------------------------------+
//[ HOSTING FIXES ]

  $lgsl_config['direct_index'] = varset($lgsl_prefs['direct_index'], 1);   // 1=link to index.php instead of the folder
  $lgsl_config['no_realpath']  = varset($lgsl_prefs['no_realpath'], 0);   // 1=do not use the realpath function
  $lgsl_config['url_path']     = varset($lgsl_prefs['url_path'], "");   // full url to /lgsl_files/ for when auto detection fails

//------------------------------------------------------------------------------------------------------------+
//[ ADVANCED SETTINGS ]

  $lgsl_config['management']    = varset($lgsl_prefs['image_mod'], 0);         // 1=show advanced management in the admin by default
  $lgsl_config['host_to_ip']    = varset($lgsl_prefs['host_to_ip'], 0);         // 1=show the servers ip instead of its hostname
  $lgsl_config['public_add']    = 0;         // 1=servers require approval OR 2=servers shown instantly
  $lgsl_config['public_feed']   = 0;         // 1=feed requests can add new servers to your list
  $lgsl_config['cache_time']    = varset($lgsl_prefs['cache_time'], 60);       // seconds=time before a server needs updating
  $lgsl_config['live_time']     = varset($lgsl_prefs['live_time'], 3);         // seconds=time allowed for updating servers per page load
  $lgsl_config['timeout']       = varset($lgsl_prefs['timeout'], 0);         // 1=gives more time for servers to respond but adds loading delay
  $lgsl_config['retry_offline'] = varset($lgsl_prefs['retry_offline'], 0);        // 1=repeats query when there is no response but adds loading delay
  $lgsl_config['cms']           = "e107";      // sets which CMS specific code to use
  $lgsl_config['image_mod']     = varset($lgsl_prefs['image_mod'], false);      // true = show userbar in server's details
	
  //include("languages/english.php");									// sets LGSL language
  // I know I can use strtolower() to have just 2 lines of the code, this is intention
  if (defined('e_LANGUAGE')) {   
	$lgsl_config['e107_language'] = e_LANGUAGE;
	
  }    
  else $lgsl_config['e107_language'] = "English";    
   
  switch ($lgsl_config['image_mod'])    {
    case "English":
        include("languages/english.php");		
        break;
    case "Russian":
        include("languages/russian.php");		
        break;
    case "French":
        include("languages/french.php");		
        break;        
    case "German":
        include("languages/german.php");		
        break;  
    case "Spanish":
        include("languages/spanish.php");		
        break;         
    case "Czech":
        include("languages/czech.php");		
        break;    
    case "Bulgarian":
        include("languages/bulgarian.php");		
        break;      
    case "Slovak":
        include("languages/slovak.php");		
        break; 
    default: 
        include("languages/english.php");		
        break;   
           
  }
 
  // English language: "languages/english.php"  		// Richard Perry
  // Russian language: "languages/russian.php"  		// Neon
  // French language: "languages/french.php"    		// own3mall
  // German language: "languages/german.php"    		// ctannurella
  // Spanish language: "languages/spanish.php"  		// own3mall
  // Czech language: "languages/czech.php"			// Neon
  // Bulgarian language: "languages/bulgarian.php"		// Neon
  // Slovak language: "languages/slovak.php"		// KristianP26

//------------------------------------------------------------------------------------------------------------+
