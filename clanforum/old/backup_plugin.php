<?php
/**
 * e107 website system
 * 
 * Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
 * Copyright (C) 2008-2010 e107 Inc (e107.org)
 * 
 * Released under the terms and conditions of the GNU General Public License
 * (http://gnu.org).
 * 
 * $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/forum/plugin.php $
 * $Revision: 12538 $
 * $Id: plugin.php 12538 2012-01-11 12:37:03Z berckoff $
 * $Author: berckoff $
 */

if (!defined('e107_INIT'))  exit;

require_once(e_PLUGIN.'clanforum/clanforum_defines.php');

include_lan(CLAN_FORUM_LANGUAGES.'lan_forum_conf.php');


# Plugin info
$eplug_name         = LAN_FORUM_INSTALL_01;
$eplug_url          = 'http://e107.org';
$eplug_email        = '';
$eplug_author       = 'e107dev';
$eplug_version      = '1.3';
$eplug_compatible   = 'e107v2.2+';
$eplug_description  = LAN_FORUM_INSTALL_02;
$eplug_readme       = '';

# Plugin options
$eplug_latest       = true;                  # Show reported threads in admin (use latest.php)
$eplug_status       = true;                  # Show post count in admin (use status.php)
$eplug_folder       = CLAN_FORUM_FOLDER;     # Name of the plugin's folder
$eplug_conffile     = CLAN_FORUM_ADMINFILE;     # Name of the admin configuration file
$eplug_menu_name    = CLAN_FORUM_FOLDER;               # Name of menu item for plugin

$eplug_link         = true;                  # Create a link in main menu (true=YES, false=NO)
$eplug_link_url     = CLAN_FORUM_SITEURL;
$eplug_link_name    = LAN_FORUM_INSTALL_01;

$eplug_done         = LAN_FORUM_INSTALL_04;  # Message for successfull instalation
$eplug_upgrade_done = sprintf(LAN_FORUM_INSTALL_05, $eplug_version);

# Icon images and caption text
$eplug_icon         = $eplug_folder.'/images/forums_32.png';
$eplug_icon_small   = $eplug_folder.'/images/forums_16.png';
$eplug_caption      = LAN_FORUM_INSTALL_03;
 
# List of plugin preferences
$eplug_prefs        = array(
	'forum_poll'          => '0',
	'forum_track'         => '0',
	'forum_title'         => LAN_FORUM_INSTALL_01,
	'forum_eprefix'       => LAN_FORUM_INSTALL_06,
	'forum_postfix'       => LAN_FORUM_INSTALL_07,
	'forum_enclose'       => '1',
	'forum_popular'       => '10',
	'forum_postspage'     => '10',
	'forum_show_topics'   => '1',
	'forum_hilightsticky' => '1',
);

                   
if (!function_exists('forum_install'))
{
	function forum_install()
	{
		$sql = new db();
		$sql->db_Update('user', "user_forums='0'");
	}
}

if (!function_exists('forum_uninstall'))
{
	function forum_uninstall()
	{
		$sql = new db();
		$sql->db_Update('user', "user_forums='0'");
	}
}