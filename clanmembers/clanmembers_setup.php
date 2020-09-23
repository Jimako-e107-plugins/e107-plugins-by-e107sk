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


if(!class_exists("clanmembers_setup"))
{
	class clanmembers_setup
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

      $eplug_version = '2.0.0';
			$e107clanmembers = array(
				'version'				=> $eplug_version,
				'gamesorteams'  	=>'Games',
				'cmtitle'  	=>'Clan Members',
				'show_opened'  	=>'1',				
				'memberorder'  	=>'Activity|DESC-Username|ASC-Rank|ASC',				
				'listorder'			=>'a:2:{s:4:"show";a:13:{i:0;s:8:"Username";i:1;s:10:"Rank Image";i:2;s:4:"Rank";i:3;s:7:"Country";i:4;s:8:"Location";i:5;s:5:"Teams";i:6;s:11:"Wars Played";i:7;s:8:"Steam ID";i:8;s:5:"Xfire";i:9;s:8:"Activity";i:10;s:9:"Join Date";i:11;s:6:"Tryout";i:12;s:10:"User Image";}s:4:"hide";a:6:{i:0;s:6:"Gender";i:1;s:3:"Age";i:2;s:5:"Games";i:3;s:8:"Last War";i:4;s:8:"Realname";i:5;s:8:"Birthday";}}',
			  'profileorder'	=>'a:2:{s:4:"show";a:18:{i:0;s:8:"Username";i:1;s:10:"Rank Image";i:2;s:4:"Rank";i:3;s:8:"Realname";i:4;s:6:"Gender";i:5;s:3:"Age";i:6;s:8:"Birthday";i:7;s:7:"Country";i:8;s:8:"Location";i:9;s:9:"Join Date";i:10;s:8:"Steam ID";i:11;s:5:"Games";i:12;s:5:"Teams";i:13;s:8:"Activity";i:14;s:11:"Wars Played";i:15;s:8:"Last War";i:16;s:6:"Tryout";i:17;s:5:"Xfire";}s:4:"hide";a:0:{}}'
			);

      $eplug_done = 'Your clan members list is now installed -  version '.$eplug_version;
      
			if($sql->insert('clan_members_config',$e107clanmembers))
			{
        $mes->add($eplug_done , E_MESSAGE_SUCCESS);
			}
			else
			{
        $mes->add('Problem with insert default data for version: '.$eplug_version , E_MESSAGE_ERROR);
			}

		}

		function uninstall_options()
		{

		}


		function uninstall_post($var)
		{
			// print_a($var);
		}

		function upgrade_post($var)
		{
			// $sql = e107::getDb();
      //$eplug_upgrade_done = 'Clan Members successfully upgraded, now using version: '.$eplug_version;
     // $this->upgradeFilePaths($needed);
      
     // return $this->upgradeCountries($needed);
		}

		/*
		 * Call During Upgrade Check. May be used to check for existance of tables etc and if not found return TRUE to call for an upgrade.
		 *
		 * @return bool true = upgrade required; false = upgrade not required
		 */
		function upgrade_required()
		{
			// Check if a specific field exists in the specified table
			// and if not return false to force a db update to add this field
			// from the "_blank_sql.php" file
			// In this case: Exists field "blank_id" in table "blank_table"
 			if(!e107::getDb()->field('clan_members_info','tryout'))
 			{
 				e107::getDb()->gen("ALTER TABLE `#clan_members_info` ADD `tryout` tinyint(1) NOT NULL DEFAULT 0 AFTER `active`");
 			} 
 			if(!e107::getDb()->field('clan_members_info','votedate'))
 			{
 				e107::getDb()->gen("ALTER TABLE `#clan_members_info` ADD `votedate` int(11) NOT NULL AFTER `tryout`");
 			}        
    }
    
  	private function upgradeFilePaths($needed)
  	{    
       		$sql = e107::getDb();
      		$mes = e107::getMessage();
      		$qry = "SELECT * FROM #clan_members_ranks WHERE rimage !='' AND SUBSTRING(rimage, 1, 3) != '{e_' ";
          
          
      		if($sql->gen($qry))
      		{
      			if($needed == TRUE){ return "Incorrect ranks image paths"; } // Signal that an update is required.
      
      			if($sql->update("clan_members_ranks","rimage = CONCAT('{e_PLUGIN}clanmembers/images/Ranks/',rimage) WHERE rimage !='' "))
      			{
      				$mes->addSuccess("Updated Ranks-Image paths");
      			}
      			else
      			{
      				$mes->addError("Failed to update Ranks-Image paths");
      			}
          }    
          
          
          $qry = "SELECT * FROM #clan_members_awards WHERE image !='' AND SUBSTRING(image, 1, 3) != '{e_' ";
          
          if($sql->gen($qry))
      		{
      			if($needed == TRUE){ return "Incorrect ranks image paths"; } // Signal that an update is required.
      
      			if($sql->update("clan_members_ranks","rimage = CONCAT('{e_PLUGIN}clanmembers/images/Awards/',rimage) WHERE rimage !='' "))
      			{
      				$mes->addSuccess("Updated Awards-Image paths");
      			}
      			else
      			{
      				$mes->addError("Failed to update Awards-Image paths");
      			}
          }
          
          $qry = "SELECT * FROM #clan_teams WHERE banner !='' AND SUBSTRING(banner, 1, 3) != '{e_' ";
          
          if($sql->gen($qry))
      		{
      			if($needed == TRUE){ return "Incorrect banner team image paths"; } // Signal that an update is required.
      
      			if($sql->update("clan_teams","banner = CONCAT('{e_PLUGIN}clanmembers/images/teams/', banner) WHERE banner !='' "))
      			{
      				$mes->addSuccess("Updated banner team image paths");
      			}
      			else
      			{
      				$mes->addError("Failed to update banner team image paths");
      			}
          }
          
          $qry = "SELECT * FROM #clan_teams WHERE icon !='' AND SUBSTRING(icon, 1, 3) != '{e_' ";
          
          if($sql->gen($qry))
      		{
      			if($needed == TRUE){ return "Incorrect icon team image paths"; } // Signal that an update is required.
      
      			if($sql->update("clan_teams","icon = CONCAT('{e_PLUGIN}clanmembers/images/teams/', icon) WHERE icon !='' "))
      			{
      				$mes->addSuccess("Updated icon team image paths");
      			}
      			else
      			{
      				$mes->addError("Failed to update icon team image paths");
      			}
          }         
        
  	}
    
  	private function upgradeCountries($needed)
  	{    
       		$sql = e107::getDb();
      		$mes = e107::getMessage();
      		$qry = "SELECT * FROM #clan_teams WHERE team_country LIKE 'Denmark'  ";
          
          
      		if($sql->gen($qry))
      		{
      			if($needed == TRUE){ return "Incorrect country code"; } // Signal that an update is required.
      
      			if($sql->update("clan_teams","team_country = 'dk' "))
      			{
      				$mes->addSuccess("Updated Team country code");
      			}
      			else
      			{
      				$mes->addError("Failed to update Team country code");
      			}
          }    
  
  	}
  }
}