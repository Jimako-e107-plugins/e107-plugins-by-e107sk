<?php
/**
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * ClanWars plugin
 *
 * @author (c) 2011 Untergang  
 * @author (c) 2019 Jimako <jimako@e107sk.com>
 * @copyright 2019  e107sk.com
 */
 
//NOTE: variables are used to have the same code as before 

class details
{

	  protected $warId              = null;
	  protected $warData            = null;
    protected $get                = array();
    protected $post               = array();
    protected $conf               = array();
    
 
    public function __construct()
    {
            $sql = e107::getDb();
     		    $this->get = $_GET;
            $this->post = $_POST;    
    				
    		//Load Config
    		$this->conf 	= e107::getDb()->retrieve("clan_wars_config", "*", " LIMIT 1");
    		//get ID to display
    		
        $this->warId	= $this->getWarId();
        
        if($this->warId)   {
    		//get data from database and prepare other default data
    		$this->warData 	= e107::getDb()->retrieve("clan_wars", "*", "wid=".$this->warId );
        
        
        //country fix legacy countries
        if($this->warData['opp_country']) {           
          if($opp_country_name = e107::getForm()->getCountry($this->warData['opp_country'])) {
            $this->warData['opp_country_name']  =  $opp_country_name;
          } 
          else {
            $this->warData['opp_country_name']  =  $this->warData['opp_country'];
          } 
        }
        else {
          $this->warData['opp_country'] = 'none'; 
          $this->warData['opp_country_name'] = ''; 
        }
        
        
    		$this->warData['team_data'] = array();  
    		$this->warData['game_data'] = array(); 
    		$this->warData['line_up'] = array(); 
    		$this->warData['screens_data'] = array();  
        $this->warData['comments_data'] = array();  
        $this->warData['maps_data'] = array();
        
        // add game data
    		$this->setGameData($this->warData['game']);                         
    		// add team data
    		$this->setTeamData($this->warData['team']); 
    		// add comments data
    		$this->setCommentsData($this->warData['wid']);
    		// add comments data
    		$this->setMapsData($this->warData['wid']);
    		// add comments data
    		$this->setLineUpData($this->warData['wid']);        
        
                
    		// add screens data
    		$this->setScreensData($this->warData['wid']);  
        if($this->warData['screens_data']) {
           e107::css('clanwars', 'includes/jquery.fancybox.css');
           e107::js('clanwars', 'includes/jquery.fancybox.js', 'jquery');
           $fancycode = 'wars_jq(document).ready(function() {
            		wars_jq("a.screens").fancybox();
            });';                   
           e107::js("footer-inline", $fancycode);
        }    
        }
    }
 
    /**
     * Return the current war id
     *
     * @return string
     */
    public function getWarId()
    {
        $wid = intval($this->get['wid']);
		    return $wid;				 
    }

    /**
     * Set the current war id
     *
     * @return string
     */
    public function setWarId($wid)
    {
         $this->get['wid'] = $wid ;
		    return ;				 
    }
        
    /**
     * Return the current war data
     *
     * @return string
     */
    public function getWarData()
    {
	   	return $this->warData ;				 
    }
    
    /**
     * Add the current team data for actual war if available
     *
     */
    public function setTeamData($team = null)
	 {	//updated related data if they exists
		if($row = e107::getDb()->retrieve("clan_teams", "*", "tid='$team' LIMIT 1 ")) {
			$this->warData['team_data']['team_name'] = $row['team_name']; 
			$this->warData['team_data']['tid'] = $row['tid']; 	
		}		 
    }

    /**
     * Add the current game data
     *
     */
    public function setGameData($game = null)
    {	
      //related data if they exists   $rowicon = $sql->retrieve("clan_games", "*", "gid = '$game' LIMIT 1");
  		if($row = e107::getDb()->retrieve("clan_games", "*", "gid='$game' LIMIT 1 " )) {     
  			$this->warData['game_data']['icon'] = $row['icon']; 
  			$this->warData['game_data']['gname'] = $row['gname']; 	
  			$this->warData['game_data']['abbr'] = $row['abbr'];	
  		}			
    }
    
    /**
     * Add the current screenshots data
     *
     */
    public function setScreensData($wid = null)
    {	//updated related data if they exists  $sql->retrieve("clan_wars_screens", "*", "wid='$wid'", true);
  		if($row = e107::getDb()->retrieve("clan_wars_screens", "*", "wid='$wid' ", true )) {
  			$this->warData['screens_data'] = $row;	
  		}			
    }
    
    /**
     * Add the current comments data
     *
     */
    public function setCommentsData($wid = null)
    {	
      //related data if they exists  $sql->retrieve("clan_wars_comments", "*", "wid='$wid' order by postdate DESC, cid DESC", true);
  		if($row = e107::getDb()->retrieve("clan_wars_comments", "*", "wid='$wid' order by postdate DESC, cid DESC ", true )) {
  			$this->warData['comments_data'] = $row;	
  		}			
    }   
    
    /**
     * Add the current comments data
     *
     */
    public function setMapsData($wid = null)
    {	
      //related data if they exists  $maplinks =  $sql->retrieve("clan_wars_maplink", "*", "wid='$wid'", true);   
  		if($maplinks = e107::getDb()->retrieve("clan_wars_maplink", "*", "wid='$wid'  ", true )) {
        foreach ($maplinks AS $rowmap) { 
           // there is key change from some reason
           $rowmap['ourscore'] = $rowmap['our_score'];
				   $rowmap['oppscore'] = $rowmap['opp_score'];
           
           if(intval($rowmap['mapname']) > 0){ 
						$rowmap2 =  e107::getDb()->retrieve("clan_wars_maps", "*", "mid=".$rowmap['mapname']." LIMIT 1");
 
						$rowmap['mapname'] = $rowmap2['name'];
            $rowmap['image']   = $rowmap2['image'];
					 }
           $image = $rowmap['image'];
						if(file_exists("images/Maps/$image") && $image !=""){
							$maps = "<img src='images/Maps/$image' width='".$this->conf['mapwidth']."px' />";
              $rowmap['maps']   = $maps;
						}          
          
           $this->warData['maps_data'][] = $rowmap ;
        }
 	
        
  		}			
    }    
     
    /**
     * Add the current LineUP data
     *
     */
    public function setLineUpData($wid = null)
    {	
      //related data if they exists  $maplinks =  $sql->retrieve("clan_wars_maplink", "*", "wid='$wid'", true);   
	    //lineup
    extract($this->warData);
		$lineup = e107::getDb()->retrieve("clan_wars_lineup", "*", "wid=".$wid." ORDER BY pid" , true);
 
		$i = 0;
    foreach($lineup as $key => $row) { 
        	if($row['available'] == 1)  {
         		if($this->conf['usesubs'] && $this->warData['players'] > 0) {
           			if($i<  $players  ) {  // 5 playes key  0,1,2,3,4 not <=
						$group = 'available';  }
					else {  
						$group = 'substitute';	}
				}
				else {
					$group = 'available';
				}
			}
			elseif($row['available'] == 0)  {
				$group = 'notavailable';
			}
        	if($row['available'] == 2)  {
           		$group = 'finished';
			}			   
            //get username
			$this->warData['line_up'][$group][$key]['membername'] = (intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			++$i;			
       }  		
    } 
       
    public function init()
    {   
     if($this->warId)   {
		 $opp_url  = $this->warData['opp_url'];
		 $opp_name = $this->warData['opp_name'];
		 $players = $this->warData['players'];
		 
		 //oponnent url fix 
		$opp_url2 = str_replace("www.", "", $opp_url);
		if (strlen($opp_url2) > 25) $opp_url2 = substr($opp_url2, 0, 25 - 3)."...";   
		$this->warData['opp_url2'] = $opp_url2; 
     
		//oponnent too long name fix     
		if (strlen($opp_name) > 25) {
			$opp_name = ""; 
			$this->warData['opp_name'] = $opp_name; 
		}	

			
		//player
		if($players=="" or $players=="0") {
			$player = "N/A";
		} else {
			$player = "$players"._WON."$players";
		}
		$this->warData['player'] = $player; 
 
  	} 
	 }
 
 
 

    
        
}