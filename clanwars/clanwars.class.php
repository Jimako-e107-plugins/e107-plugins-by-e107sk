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

class clanwars
{
 
  protected $sc;
  protected $warId              = null;
  protected $get                = array();
  protected $post               = array();
  protected $conf               = array();
  
	public function __construct()
	{
		$this->get = $_GET;
		$this->post = $_POST;

    $this->sc1 =  e107::getScBatch('clanwars');
    $this->sc2 =  e107::getScBatch('clanwars','clanwars','layout' );
    

    //Load Config
		$this->conf 	= e107::getDb()->retrieve("clan_wars_config", "*", " LIMIT 1");	
    
  }
  
	public function render()
	{
    $ns = e107::getRender();
    if(intval($this->get['wid']))
		{
        $this->warId = intval($this->get['wid']);
        $text = $this->detailView($this->warId);
        
        $ns->tablerender($text['caption'], $text['body'], 'clanwars');
    } 
    
    
  }
  
  
	protected function detailView($wid=0)
	{
    $tp = e107::getParser();
    
    
    if(!$row = e107::getDb()->retrieve("clan_wars", "*", "wid=".$wid ." LIMIT 1"  ))  
		{     
      $text['body'] = "<br /><br /><div class='text-center'>War not found.</div><br /><br />";
      $text['caption'] = _CLANWARS;
      return $text;
		}
    
    $this->warData = $row;
 
    require_once(e_PLUGIN.'clanwars/public/details.class.php');
    $singlewar = new details;
    $singlewar->init();
    $singlewar->setWarId($wid);
    $result = $singlewar->getWarData();
	  $this->sc1->setVars($result);  
    $this->sc2->setVars($result);
    $this->sc2->wrapper('layout/details');
    $template = e107::getTemplate('clanwars', 'layout', 'details'); 
 
      
    $text['caption'] = $tp->parseTemplate($template['caption'], true, $this->sc2); 
  
    $text['body'] = $tp->parseTemplate($template['body'], true, $this->sc2);    
 
    return $text;
    
     
  }
     
}