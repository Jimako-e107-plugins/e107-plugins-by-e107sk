<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Disqus Plugin
 *
 * #######################################
 * #     e107 website system plugin      #
 * #     by Jimako                    	 #
 * #     https://www.e107sk.com          #
 * #######################################
 */

require_once('../../class2.php');

if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

 e107::lan('disqus',true);


class disqus_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'disqus_ui',
			'path' 			=> null,
			'ui' 			=> 'disqus_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(

		'main/prefs' 		=> array('caption'=> LAN_DISQUS_LAN_03,   'perm' => 'P', 'url'=>'admin_config.php')
		
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Disqus';
}
 
				
class disqus_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_DISQUS_LAN_02;
		protected $pluginName		= 'disqus';
		protected $listOrder		= ' DESC';	
		protected $fields 		= NULL;				
		protected $fieldpref = array();
 
 	    protected $preftabs  = array("General", "Discussion", "Menus", "Counts", 'Lazy Loading');
		protected $prefs = array(
			'forum_shortname' =>  array(	
				'title'  		=> "Your Forum Shortname" ,
				'type'		   	=> 'text',
				'data'		   	=> 'str',
				'help'		   	=> 'Insert your forum shortname ',
				'writeParms'   	=> array( 
					'size'  => 'block-level',	
				),
			),

			'use_lazyloading'		=> 
				array('title'  => "Lazy-loading Disqus comments" ,
				'tab'		   => 0,
				'type'		   => 'boolean',
				'data'		   => 'int',
				'help'		   => 'Use lazy-loading Disqus comments'
			),

			'laziness'		=> 
				array('title'  => "laziness " ,
				'tab'		   => 4,
				'type'		   => 'number',
				'data'		   => 'int', 
				'writeParms'    => array('default'=>1),
				 
			),

			'throttle'		=> 
				array('title'  => "throttle  " ,
				'tab'		   => 4,
				'type'		   => 'number', 
				'data'		   => 'int', 
				'writeParms'    => array('default'=>250),	 
			),

			'hide_poweredby'		=> 
				array('title'  => "Hide Powered By in Combination menu" ,
				'tab'		   => 2,
				'type'		   => 'boolean',
				'data'		   => 'str',
				'help'		   => ''
			),

			'hide_entity_news'		=> 
				array('title'  => "Disable for News Item Entity" ,
				'tab'		   => 1,
				'type'		   => 'boolean',
				'data'		   => 'str',
				'help'		   => 'Item setting is ignored then'
			),		
			
			'hide_entity_page'		=> 
				array('title'  => "Disable for Pages Entity" ,
				'tab'		   => 1,
				'type'		   => 'boolean',
				'data'		   => 'str',
				'help'		   => 'Item setting is ignored then'
			),	

			'hide_entity_content-cat'		=> 
				array('title'  => "Disable for Content Category Entity" ,
				'tab'		   => 1,
				'type'		   => 'boolean',
				'data'		   => 'str',
				'help'		   => 'Disqus is displayed only on specific comment category page then, not on category page itself'
			),

			'activate_counts'		=> 
				array('title'  => "Activate counts [if you don't need comments counts, leave it off]. " ,
				'tab'		   => 3,
				'type'		   => 'boolean',
				'data'		   => 'str',
				'help'		   => 'It saves sources - needed script is not loaded'
			),

            'help_tab_general' => array(
				'title'  => 'Help',  
                'type' => 'method', 'title'=>false, 
                'data' => null
			),

            'help_tab_discussion' => array(
				'title'  => 'Help',  
                'type' => 'method',  'tab'=>1,  'title'=>false, 
                'data' => null
			),

            'help_tab_menu' => array(
				'title'  => 'Help',  
                'type' => 'method', 'tab'=>2,  'title'=>false, 
                'data' => null
			),

            'help_tab_lazines' => array(
				'title'  => 'Help',  
                'type' => 'method', 'tab'=>4,  'title'=>false, 
                'data' => null
			),
 		); 

	
		public function init()
		{
			

		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
 	
}
				


class disqus_form_ui extends e_admin_form_ui
{

	 function help_tab_lazines() {
		$ret[0][info] = 'Lazy loading source: https://css-tricks.com/lazy-loading-disqus-comments/ ';

		$ret[1][info] = '
		<b>laziness</b><br> Sets the laziness of loading the widget: (viewport height) * laziness . For example:
		0 - widget load starts when at the least a tiny part of it gets in the viewport;
		1 - widget load starts when the distance between the widget zone and the viewport is no more than the height of the viewport;
		2 - 2x viewports, etc.';

		$ret[2][info] = '
		<b>throttle</b><br> Defines how often the plugin should make calculations during the
		processes such as resize of a browser\'s window or viewport scroll.
		250 = 4 times in a second.';		

		foreach($ret AS $key=>$value) {
			$text .= "
			<div class='s-message'> <div class='s-message alert alert-block  alert-".key($value)."' >
			".current($value)."
			</div> </div>
			";
		}

		return $text;
	 }


     function  help_tab_general() {
		$engine = e107::pref('core','comments_engine','e107');
	
		if($engine != "disqus::disqus") 
		{
			$ret[0]['danger'] = 'For activation select disqus engine in your Comment Manager ';
		}
		else {
			$ret[0]['info'] = 'Your comment engine is set to disqus. ';
		}
		
		// $ret[1][warning] = 'Warning: With both engines DSisqus is displayed on all pages of that entity. For now.  ';
		
		$ret[2][info] = 'Supported entities: single news item, single page, content category page ';

		foreach($ret AS $key=>$value) {
			$text .= "
			<div class='s-message'> <div class='s-message alert alert-block  alert-".key($value)."' >
			".current($value)."
			</div> </div>
			";
		}

		return $text;
	 }
	 
	 function  help_tab_discussion() {
		$ret[0][info] = 'If you set f.e. pages off, no discussion will be displayed for all pages';
		 
		foreach($ret AS $key=>$value) {
			$text .= "
			<div class='s-message'> <div class='s-message alert alert-block  alert-".key($value)."' >
			".current($value)."
			</div> </div>
			";
		}

		return $text;
	  }

	 function  help_tab_menu() {
		$ret[0][info] = 'Supported menus: Recent Comments, Combination Comments  ';
		$ret[1][warning] = 'Warning: menus use widget system that is not officially supported anymore.  ';
		$ret[2][info] = 'Add menu via Menu manager and click on Configuration button. ';
		foreach($ret AS $key=>$value) {
			$text .= "
			<div class='s-message'> <div class='s-message alert alert-block  alert-".key($value)."' >
			".current($value)."
			</div> </div>
			";
		}

		return $text;
	  }

}		
		
		
new disqus_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

