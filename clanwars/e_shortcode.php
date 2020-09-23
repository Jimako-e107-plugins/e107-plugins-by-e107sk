<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Featurebox shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT')) { exit; }

class clanwars_shortcodes extends e_shortcode
{
	var $singlewar = null;
	
	function __construct()
	{
 
	}

    /**
   * {WAR_CAPTION}
   *
   * @return string  
   */
    public function sc_war_caption()
    { 
    extract($this->var);
    extract($this->var['team_data']);
    
		if($team_name) {
			$title = _CLANWARS.": ".$team_name." "._WVS." ".(($opp_name !="")?$opp_name:$opp_tag);
		}else{
			$title = _CLANWARS;
		}
		return $title;
    }
    
    
    
    

}
?>