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

if (!defined('e107_INIT'))
{
	exit;}

//v2.x Standard for extending menu configuration within Menu Manager. (replacement for v1.x config.php)

class disqus_menu
{
	public function __construct()
	{
		// e107::lan('disqus','menu',true); // English_menu.php or {LANGUAGE}_menu.php
	}

	/**
	 * Configuration Fields.
	 * @return array
	 */
	public function config($menu = '')
	{
		$fields = array();
		switch ($menu)
		{
		case "recent_comments":

			$fields['block_title'] = array('title' => "Caption", 'type' => 'text', 'multilan' => true, 'writeParms' => array('size' => 'xxlarge'));
			$fields['block_num_items'] = array('title' => "Item Number", 'type' => 'number', 'writeParms' => array('default' => '10'));
			$fields['block_hide_avatars'] = array('title' => "Hide Avatars", 'type' => 'boolean', 'writeParms' => array('default' => '0'));
			$fields['block_avatar_size'] = array('title' => "Avatar Size", 'type' => 'number', 'writeParms' => array('default' => '40'));
			$fields['block_excerpt_length'] = array('title' => "Excerpt Length", 'type' => 'number', 'writeParms' => array('default' => '200'));
			$fields['block_style'] = array('title' => "Style code [theme support]", 'type' => 'text', 'writeParms' => array('size' => 'xxlarge'));
			$fields['block_tablestyle'] = array('title' => "ID for tablestyle [theme support]", 'type' => 'text', 'writeParms' => array('size' => 'xxlarge'));

			return $fields;

		case "combination_comments":

			$fields['block_title'] = array('title' => "Caption", 'type' => 'text', 'multilan' => true, 'writeParms' => array('size' => 'xxlarge'));
			$fields['block_num_items'] = array('title' => "Item Number", 'type' => 'number', 'writeParms' => array('default' => '10'));
			$fields['block_hide_mods'] = array('title' => "Hide Moderators", 'type' => 'boolean', 'writeParms' => array('default' => '0'));
			$fields['block_color'] = array('title' => "Widget color", 'type' => 'text', 'writeParms' => array('default' => 'grey', 'help' => 'blue, grey, green, red, orange'));
			$fields['block_excerpt_length'] = array('title' => "Excerpt Length", 'type' => 'number', 'writeParms' => array('default' => '200'));
			$fields['block_default_tab'] = array('title' => "Default Tab", 'type' => 'text', 'writeParms' => array('default' => 'recent', 'help' => 'people, recent, popular'));

			$fields['block_style'] = array('title' => "Style code [theme support]", 'type' => 'text', 'writeParms' => array('size' => 'xxlarge'));
			$fields['block_tablestyle'] = array('title' => "ID for tablestyle [theme support]", 'type' => 'text', 'writeParms' => array('size' => 'xxlarge'));

			return $fields;
		}
	}
}
