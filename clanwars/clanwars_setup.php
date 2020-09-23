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

//ALTER TABLE `e107_clan_wars_config` CHANGE `mapwidth` `mapwidth` VARCHAR(5) NOT NULL DEFAULT '180px';


if(!class_exists("clanwars_setup"))
{
	class clanwars_setup
	{

	    function install_pre($var)
		{
			// print_xa($var);
			// echo "custom install 'pre' function<br /><br />";
		}

		/**
		 * For inserting default database content during install after table has been created by the blank_sql.php file.
		 */
		function install_post($var)
		{
			$sql = e107::getDb();
			$mes = e107::getMessage();

      $eplug_version = '2.0.0';
			$e107clanwars = array(
				'version'				=> $eplug_version 
			);
      $eplug_done = 'Your clan wars list is now installed -  version '.$eplug_version;
      
			if($sql->insert('clan_wars_config',$e107clanwars))
			{
				$mes->add('Your Clan Wars list is now installed, your version: '.$eplug_version , E_MESSAGE_SUCCESS);
			}
			else
			{
				$mes->add('Problem with insert default data '.$eplug_version , E_MESSAGE_ERROR);
			}
			
     $query_games = "CREATE TABLE IF NOT EXISTS `#clan_games` (
				  gid int(11) NOT NULL AUTO_INCREMENT,
				  abbr VARCHAR(20) DEFAULT NULL,
				  gname VARCHAR(50) NOT NULL,
				  banner VARCHAR(50) DEFAULT NULL,
				  icon VARCHAR(50) DEFAULT NULL,
				  inmembers tinyint(1) NOT NULL DEFAULT '1',
				  inwars tinyint(1) NOT NULL DEFAULT '1',
				  position int(3) NOT NULL,
				  PRIMARY KEY (gid) 
					) ENGINE=MyISAM;";
          
      $query_teams = "CREATE TABLE IF NOT EXISTS `#clan_teams` (
                  	`tid` int(11) NOT NULL AUTO_INCREMENT,
                    `team_tag` varchar(25) NOT NULL,
                    `team_name` varchar(50) NOT NULL,
                    `team_country` varchar(30) NOT NULL DEFAULT 'Unknown',
                    `banner` varchar(50) DEFAULT NULL,
                    `icon` varchar(50) DEFAULT NULL,
                    `inmembers` tinyint(1) NOT NULL DEFAULT '1',
                    `inwars` tinyint(1) NOT NULL DEFAULT '1',
                    `position` int(3) NOT NULL,
                    PRIMARY KEY (`tid`)
                  ) ENGINE=MyISAM;";
                       
      if(!e107::getDb()->isTable('clan_games') OR !e107::getDb()->isTable('clan_teams') )
 			{
					e107::getDb()->gen($query_games);		
          e107::getDb()->gen($query_teams);		
			 
 			}
      
      if(!e107::getDb()->isTable('clan_games'))
 			{    
					e107::getDb()->gen($query_games);				
 	
 			}
      
      if(!e107::getDb()->isTable('clan_teams'))
 			{
					e107::getDb()->gen($query_teams);					
 	
 			}			

		}

		function uninstall_options()
		{

		}


		function uninstall_post($var)
		{
			// print_xa($var);
		}

		function upgrade_post($var)
		{
			// $sql = e107::getDb();
      // //$eplug_upgrade_done = 'Clan Members successfully upgraded, now using version: '.$eplug_version;
		}
    
		/*
		 * Call During Upgrade Check. May be used to check for existance of tables etc and if not found return TRUE to call for an upgrade.
		 *
		 * @return bool true = upgrade required; false = upgrade not required
		 */
		function upgrade_required()
		{
      
      $query_games = "CREATE TABLE IF NOT EXISTS `#clan_games` (
				  gid int(11) NOT NULL AUTO_INCREMENT,
				  abbr VARCHAR(20) DEFAULT NULL,
				  gname VARCHAR(50) NOT NULL,
				  banner VARCHAR(50) DEFAULT NULL,
				  icon VARCHAR(50) DEFAULT NULL,
				  inmembers tinyint(1) NOT NULL DEFAULT '1',
				  inwars tinyint(1) NOT NULL DEFAULT '1',
				  position int(3) NOT NULL,
				  PRIMARY KEY (gid) 
					) ENGINE=MyISAM;";
          
      $query_teams = "CREATE TABLE IF NOT EXISTS `#clan_teams` (
                  	`tid` int(11) NOT NULL AUTO_INCREMENT,
                    `team_tag` varchar(25) NOT NULL,
                    `team_name` varchar(50) NOT NULL,
                    `team_country` varchar(30) NOT NULL DEFAULT 'Unknown',
                    `banner` varchar(50) DEFAULT NULL,
                    `icon` varchar(50) DEFAULT NULL,
                    `inmembers` tinyint(1) NOT NULL DEFAULT '1',
                    `inwars` tinyint(1) NOT NULL DEFAULT '1',
                    `position` int(3) NOT NULL,
                    PRIMARY KEY (`tid`)
                  ) ENGINE=MyISAM;";
                       
      if(!e107::getDb()->isTable('clan_games') OR !e107::getDb()->isTable('clan_teams') )
 			{
					e107::getDb()->gen($query_games);		
          e107::getDb()->gen($query_teams);		
					return true;	
 			}
      
      if(!e107::getDb()->isTable('clan_games'))
 			{    
					e107::getDb()->gen($query_games);				
					return true;	
 			}
      
      if(!e107::getDb()->isTable('clan_teams'))
 			{
					e107::getDb()->gen($query_teams);					
					return true;	
 			}
    
		}

	}

}