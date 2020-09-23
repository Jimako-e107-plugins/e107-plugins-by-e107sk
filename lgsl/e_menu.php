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
	
class lgsl_menu
{
	function __construct()
	{
		// e107::lan('lgsl','menu',true); // English_menu.php or {LANGUAGE}_menu.php
	}

	/**
	 * Configuration Fields.
	 * @return array
	 */
	public function config($menu='')
	{
	    $fields = array();
        $zone_number = e107::pref('lgsl', 'zone_numbers', 8);
        for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++) {
          $zone_list[$fieldkey] = $fieldkey;
        }
        
    	switch($menu)
		{   
        	case "lgsl":
				$fields['lgsl_menu_title']        = array('title'=> "Caption", 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));
				$fields['lgsl_zone_number']       = array('title'=> "LGSL Zone Number", 'type'=>'dropdown', 'writeParms'=>array('optArray'=>$zone_list, 'default'=>'blank'), 'help'=>'');
				$fields['lgsl_menu_style']        = array('title'=> "Style code [theme support]", 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge' ));              
				$fields['lgsl_menu_tablestyle']   = array('title'=> "ID/Mode for tablestyle [theme support]", 'type'=>'text', 'writeParms'=>array('size'=>'xxlarge' ));  
            return $fields;
   		}	 
	}
}
 