<?php
/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom install/uninstall/update routines for blank plugin
**
*/

if (!defined('e107_INIT'))  exit;

require_once(e_PLUGIN.'clanforum/clanforum_defines.php');

include_lan(CLAN_FORUM_LANGUAGES.'lan_forum_conf.php');

if(!class_exists("clanforum_setup"))
{
	class clanforum_setup
	{

	    function install_pre($var)
		{
			// print_a($var);
			// echo "custom install 'pre' function<br /><br />";
		}

		/**
		 * For inserting default database content during install after table has been created by the blank_sql.php file.
		 */
		function install_post($var)
		{
			$sql = e107::getDb();
			$mes = e107::getMessage();
      
      /* fix for not able to use lan values in plugin.xml */
      e107::getPlugConfig(CLAN_FORUM_FOLDER)->set('forum_title', LAN_FORUM_INSTALL_01)->save(true);
      e107::getPlugConfig(CLAN_FORUM_FOLDER)->set('forum_eprefix', LAN_FORUM_INSTALL_06)->save(true);
      e107::getPlugConfig(CLAN_FORUM_FOLDER)->set('forum_postfix', LAN_FORUM_INSTALL_07)->save(true);
		}

		function uninstall_options()
		{
 
		}


		function uninstall_post($var)
		{
			// print_a($var);
		}


		/*
		 * Call During Upgrade Check. May be used to check for existance of tables etc and if not found return TRUE to call for an upgrade.
		 *
		 * @return bool true = upgrade required; false = upgrade not required
		 */
		function upgrade_required()
		{
 

			return false;
		}


		function upgrade_post($var)
		{
			// $sql = e107::getDb();
		}

	}

}