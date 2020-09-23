<?php
	class plugin_clanwars_layout_shortcodes extends e_shortcode
	{
    protected $conf               = array();

        
         
		public function __construct()
		{
     //Load Config
  	 $this->conf 	= e107::getDb()->retrieve("clan_wars_config", "*", " LIMIT 1");
		}
 
	function sc_detail_caption4()
	{
 
		 return 'hello word4';
	}
  
    /**
   * {WAR_OPPONENT}
   *
   * @return string  
   */
    public function sc_war_opponent()
    { 
    extract($this->var);
 
		//todo: full url path for https urls
    	$text = "<table  class='table table-bordered fborder opponent'>
				<tr>
					<td class='fcaption' colspan='2' style='text-align: center;'><b>"._WOPP."</b></td>
				</tr>
				<tr>
					<td align='left' class='forumheader2'>"._WNAME."</td>
					<td align='left' class='nowrap forumheader3' >$opp_tag";
					if($opp_tag !="" && $opp_name !=""){
						$text .= "&nbsp;-&nbsp;";
					}
					$text .= "$opp_name</td>
				</tr>
				<tr>
					<td align='left' class='forumheader2'>"._WCOUNTRY."</td>
					<td align='left' class='nowrap forumheader3'><img  src='".e_IMAGE."clan/flags/$opp_country.png' class='absmiddle'>&nbsp;$opp_country_name</td>
				</tr>
				<tr>
					<td align='left' class='forumheader2'>"._WURL."</td>
					<td align='left' class='nowrap forumheader3'><a href='http://$opp_url' target='_blank'>$opp_url2</a></td>
				</tr>
				</table>";
    
      return $text;
    }

    /**
   * {WAR_MATCH}
   *
   * @return string  
   */
    public function sc_war_match()
    { 
     extract($this->var);
     extract($this->var['game_data']);
 	
		$text = "<table width='100%' class='table table-bordered fborder match'>
			<tr>
				<td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WMATCH."</b></div></td>
			</tr>
			<tr>
				<td align='left' class='nowrap forumheader2'>"._WGAME."</td>
				<td align='left' class='nowrap forumheader3'>";
		
				if(file_exists(e_IMAGE."clan/games/$icon") && $icon !="")    {
				$text .= "<img src='".e_IMAGE."clan/games/$icon' alt='".($abbr?$abbr:$gname)."' title='$gname' class='absmiddle'>&nbsp;";
        }
				$text .= "$gname</td>
      		</tr>
			<tr>
				<td align='left' class='nowrap forumheader2'>"._WSTYLE."</td>
				<td align='left' class='nowrap forumheader3'>$style</td>
			</tr>
			<tr>
				<td align='left' class='nowrap forumheader2'>"._WPLAYERS."</td>
				<td align='left' class='nowrap forumheader3'>$player</td>
			</tr>
    		</table>";
			return $text;	        
    }
    
        
    /**
   * {WAR_OTHER}
   *
   * @return string  
   */
    public function sc_war_other()
    { 
      extract($this->var);
		$conf = $this->conf;
		
		$text = "<table  class='table table-bordered fborder other'>
			<tr>
				<td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WOTHER."</b></div></td>
			</tr>
			<tr>
				<td align='left' class='forumheader2'>"._WSTATUS."</td>
				<td align='left' class='nowrap forumheader3'>".(($status)?_WFINISHED:_WNEXTMATCH)."</td>
				</tr>
			<tr>
				<td align='left' class='forumheader2'>"._WDATE."</td>
				<td align='left' class='nowrap forumheader3' >".(($wardate == -1) ? "" : date($conf['formatdetails'], $wardate))."</td>
			</tr>
			<tr>
			<td align='left' class='forumheader2'>"._WRESULT."</td>";
				if($status==1){
					if ($our_score > $opp_score){
						$scorecolor = "#009900";
					}elseif($our_score < $opp_score){
						$scorecolor = "#990000";
					}else{
						$scorecolor = "#3333FF";
					}
					if($conf['colorbox']){
						//Colored Boxes					
						$text .= "<td class='nowrap forumheader3' style='background-color:$scorecolor'><b style='color: #FFF;'>$our_score/$opp_score</b></td>";
					}else{
						//Colored Text					
						$text .= "<td class='nowrap forumheader3'><b style='color: $scorecolor;'>$our_score/$opp_score</b></td>";			
					}
				}else{
					$text .= "<td align='left' class='forumheader3 '  >N/A</td>";
				}
			$text .= "</tr>
			</table>";
		return $text;	           
    }    
    
    
    /**
   * {WAR_RESULTSBYMAP}
   *
   * @return string  
   */
    public function sc_war_resultsbymap()
    { 
 
      extract($this->var);
      $maplinks =  $this->var['maps_data'] ;
 
		  $conf = $this->conf;
 
if($conf['scorepermap'] && $status) {
$results .= "<table width='100%' class='table table-bordered fborder  mapresults'>
			  <tr>
				<td class='fcaption' colspan='3'><div style='text-align: center;'><b>". _RESULTS ."</b></div></td>
			  </tr>";
			$scores = 0;
         
			   foreach ($maplinks AS $rowmap) {
					$mapname = $rowmap['mapname'];
					$gametype = $rowmap['gametype'];
					$ourscore = $rowmap['our_score'];
					$oppscore = $rowmap['opp_score'];      
    
					if($conf['scorepermap'] && $status){
						$score = "";
						$colspan = " colspan='2'";
						if($ourscore > 0 or $oppscore > 0){
							$scores++;
							$colspan = "";
							if ($ourscore > $oppscore){
								$scorecolor = "#009900";
							}elseif($ourscore < $oppscore){
								$scorecolor = "#990000";
							}else{
								$scorecolor = "#3333FF";
							}
							if($conf['colorbox']){
								//Colored Boxes					
								 $score = "<td style='text-align:center;' width='30%' class='nowrap forumheader3' style='background:url() $scorecolor;' ><b style='color: #FFF;'>$ourscore/$oppscore</b></td>";
							}else{
								//Colored Text					
								 $score = "<td style='text-align:center;' width='30%' class='nowrap forumheader3' ><b style='color: $scorecolor;'>$ourscore/$oppscore</b></td>";
							}
						}
					}
					$results .= "<tr>
							<td align='left' class='nowrap forumheader2' width='30%' >$mapname&nbsp;</td>
							<td align='left' class='nowrap forumheader3' ".($conf['scorepermap']?$colspan:"").">$gametype</td>";
							if($conf['scorepermap'] && $status) $results .= $score;
						  $results .= "</tr>";
				  }
    	$results .= "</table>";
    
     return $results;
 }
 else return '';
    }    
    
    
   /**
   * {WAR_SERVER}
   *
   * @return string  
   */
    public function sc_war_server()
    { 
      extract($this->var);
		  $conf = $this->conf;

      	$showip = false;
      	if(($conf['showip'] or $status == 0) && canviewserver() && ($serverip !="" or $serverpass !="" )){
      		$showip = true;
      	}
  
  
      if($showip){ 
         $text = "<table width='100%' class='table table-bordered fborder    serverinfo'>
  		  <tr>
  			<td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WSERVER."</b></div></td>
  		  </tr>
  		  <tr>
  			<td align='left' class='nowrap forumheader2'>"._WIP."</td>
  			<td align='left' class='nowrap forumheader3' width='95%'>$serverip</td>
  		  </tr>
  		  <tr>
  			<td align='left' class='nowrap forumheader2'>"._WPASS."</td>
  			<td align='left' class='nowrap forumheader3'>$serverpass</td>
  		  </tr>
  	</table>";
		return $text;	 
      }
    }
    
    
   /**
   * {WAR_REPORT}
   *
   * @return string  
   */
    public function sc_war_report()
    { 
    
      extract($this->var);
		  $conf = $this->conf;
      if($report!="" or $report_url!=""){ 
		//todo: replace urls with https option
		$text = "<table width='100%' class='table table-bordered fborder     report'>
				<tr>
					<td class='fcaption'><div style='text-align: center;'><b>"._WREPORT."</b></div></td>
				</tr>";
		if($report!=""){
		$text .= "<tr>
				<td align='left' class='forumheader2'>".nl2br($report)."</td>
			</tr>";
		}if($report_url!="" && $report_url!="/"){
		$text .= "<tr>
				<td class='nowrap forumheader3 text-center'><a href='http://$report_url' target='_blank'>"._WREPORTURL."</a></td>
			</tr>";
		}
		$text .= "</table>";
 
		return $text;
     }
     else return '';
    }
    
    
    
   /**
   * {WAR_LINEUP}
   *
   * @return string  
   */
    public function sc_war_lineup()
    {
      extract($this->var);
		  $conf = $this->conf;
      
    if($conf['enablelineup'] && ((!$conf['guestlineup'] && USER) or $conf['guestlineup'])){  
      
		$players = $this->var['players'];
    
		$arows = count($this->var['line_up']);
 	  $members = $this->var['line_up'];
      	if($status==0) { 
         	if(canlineup(($wholineup == 1?$tid:$game), $wholineup) or $arows > 0){
				$text = "
				<table  class='table fborder table-bordered  lineup'>
					<tr>
						<td class='fcaption' colspan='2' style='text-align: center;'><b>"._WLINEUP."</b></td>
					</tr>";
			}
			//available members
 			sort($members['available']);
			$available = count($members['available']);	
			$text .= "<tr ".(($available>0) ? "" : "style='display:none;'")." id='travailable'>
						<td align='left' class='nowrap forumheader2' width='15%' valign='top' >"._WAVAIL."&nbsp;</td>
						<td align='left' class='forumheader3 ' width='85%' id='available'>"; 
			$i = 0;
			foreach($members['available'] as $member){     
				$text .= $member['membername'].(($i < $available) ? ", " : "");
				$i++;
			}
			$text .= "</td></tr>";		
			//substitutes 	 
			sort($members['substitute']);
			$subs = count($members['substitute']);  
			if($conf['usesubs']){
			$i=1;
			$text .= "<tr ".(($subs>0 && $players>0) ? "" : "style='display:none;'")." id='trsubs'>
				<td align='left' class='nowrap forumheader2' width='15%' valign='top' >"._WSUBS."&nbsp;</td>
				<td align='left' class='forumheader3' width='85%' id='subs'>"; 
				if($players>0){

					foreach($members['substitute'] as $member){      
						$text .= $member['membername'].(($i < $subs) ? ", " : "");
						$i++;
					}
				}
				$text .= "</td>
				</tr>";
			}
 			sort($members['notavailable']);
 			$notavailable= count($members['notavailable']);				
			$text .= "<tr ".(($notavailable>0) ? "" : "style='display:none;'")." id='trunavailable'>
			<td align='left' class='nowrap forumheader2' width='15%' valign='top' >"._WNOTAVAIL."&nbsp;</td>
			<td align='left' class='forumheader3' width='85%' id='unavailable'>";				
			
			foreach($members['notavailable'] as $member){      
				$text .= $member['membername'].(($i < $notavailable) ? ", " : "");
				$i++;
			}	
			$text .= "</td>
			</tr>";						 
	
			//Submit availability 
			if(canlineup(($wholineup == 1?$tid:$game), $wholineup)){
			
				$entered = e107::getDb()->count("clan_wars_lineup", "(*)", "where member='".USERID."' and wid='$wid'");

				$text .= "<tr>
						<td colspan='2' class='forumheader3' style='text-align: center;'>
						<div".(($entered)?"":" style='display:none;'")." id='dellineup'>
							<input type=\"button\" class=\"iconpointer button btn\" value=\""._WCHANGEAVAIL."\" onclick=\"DelFromLineup()\">
						</div>
						<div".(($entered)?" style='display:none;'":"")." id='addlineup'>
							<form>
							<select id='availability' class='tbox form-control'>
								<option value='1'>"._WILLPLAY."</option>
								<option value='0'>"._WICANT."</option>
							</select>
							<input type=\"button\" class=\"iconpointer button btn\" value=\""._WSUBMIT."\" onclick=\"AddToLineup()\">
							</form>
						</div>
						</td>
					</tr>";
			}
		  
			if(canlineup(($wholineup == 1?$tid:$game), $wholineup) or $arows>0){
				$text .= "</table>";    
			}
			$text .= "</table>";
			return $text;      
		}
		else {
			sort($members['finished']);
			$finished= count($members['finished']);			
							
			if($finished > 0) {
				$text .= "<tr>
				<td colspan='2'>
				<table class='table fborder table-bordered   finishedwar'>
					<tr>
						<td class='fcaption' colspan='2' style='text-align: center;'><b>"._WLINEUP."</b></td>
					</tr>";
				$text .= "<tr>
				<td align='left' class='nowrap forumheader2' width='15%' valign='top' >"._WMEMPLAYED."&nbsp;</td>
				<td align='left' class='forumheader3' width='85%'>"; 

				foreach($members['finished'] as $member){
					$text .= $member['membername'].(($i < $players) ? ", " : "");
					$i++;
				}
				$text .= "</td>
				</tr>
				</table>";
				return $text;   
			}
		}  
    }
     else { return ''; }
    }
    
    
   /**
   * {WAR_COMMENTS}
   *
   * @return string  
   */
    public function sc_war_comments()
    {

    		 $conf = $this->conf;  
    if($conf['enablecomments'] && ($conf['guestcomments'] or USER or (ADMIN && getperms("P")))){
 
		 extract($this->var);

		$comments = $this->var['comments_data'];
 
  	$text = "<table class='table fborder table-bordered   comments'>
				<tr>
					<td class='fcaption' ><div class='text-center'><b>"._WCOMMENTS."</b></div></td>
				</tr>
				<tr>
					<td align='left'><div id='commentsdiv'>";

 
		foreach ($comments as $row) {
			$cid = $row['cid'];
			$poster = cw_getuser_name($row['poster']);
			$comment = $row['comment'];
			$postdate = $row['postdate'];
			
		$text .= "<div class='mainwrap forumheader3' id='comment$cid'>
				<table class='table noborder'>
					<tr>
						<td width='100%' align='left' valign='top'><b>$poster</b><br /><div id='commenttext$cid' style='padding-left:2px;'>".nl2br($comment)."</div></td>";
					if((ADMIN && getperms("P")) or $poster == USERNAME){
						$text .= "<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button btn\" value=\""._WEDIT."\" onclick=\"EditComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button\" class=\"iconpointer button btn\" value=\""._WDEL."\" onclick=\"DelComment($cid)\"></td>";
					}
					$text .= "</tr>
				</table>
			</div>";
			if((ADMIN && getperms("P")) or $poster == USERNAME){
			$text .= "<div class='mainwrap forumheader3' id='editcomment$cid' style='display:none;'>
				<table class='table  noborder'>
					<tr>
						<td width='100%' align='left' valign='top'><b>$poster</b><br /><textarea id='commarea$cid' class='tbox form-control'>$comment</textarea></td>
						<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button btn\" value=\""._WSAVE."\" onclick=\"SaveComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button btn\" class=\"iconpointer button btn\" value=\""._WCANCEL."\" onclick=\"CancelComment($cid)\"></td>
					</tr>

				</table>
			</div>";
			}
		}
	$text .= "</div>";
	if (ADMIN && getperms("P") && count($comments)  > 1) {
		$text .= "<div class='mainwrap' style='text-align:right;' id='delallcommsdiv'><div style='padding:2px;'><input type=\"button btn\" class=\"iconpointer button btn\" value=\"Delete All\" onclick=\"DelAllComments()\"></div></div>";
	}
	if(USER){
		$text .= "<div class='mainwrap forumheader2' style='margin-bottom:0px;'>
			<table class='table text-center noborder'>
				<tr>
					<td width='100%'><textarea class='tbox form-control'  id='comment'></textarea></td>
				</tr>                                
				<tr>
					<td style='text-align: right;'><input type=\"button\" class=\"iconpointer button btn\" value=\""._WADDCOMMENT."\" onclick=\"AddComment()\"></td>
				</tr>
			</table>
		</div>";
	}else{
		$text .= "<div class='mainwrap' style='text-align:center;margin-bottom:0px;'><div style='padding:2px;'>&nbsp;<br />"._WLOGINBEFOREPOST."<br />&nbsp;</div></div>";
	}
	$text .= "</td></tr></table>"; 
  
    return $text;
    } 
    else {
     return '';
    }
      
   }   
   
   
   
   
   
   /**
   * {WAR_SCREENS}
   *
   * @return string  
   */
    public function sc_war_screens()
    { 
    //todo time shortcut 
		extract($this->var);		
 
		$conf = $this->conf;
		$maps = $this->var['screens_data'];
 
  	$text = "<table class='table fborder images'>
				<tr>
					<td class='fcaption' style='text-align: center;'><b>"._WSCRSHOTS."</b></td>
				</tr>
				<tr>
					<td class='forumheader3' style='text-align: center;'>
						<table class='table' >\n";
					$screens = 0;
					$i=1;
					foreach ($maps as $row) {
						$url = $row['url'];
						
						$thumbexists = false;
						if(file_exists("images/Screens/thumbs/$url") && $url!="" && $conf['createthumbs']){
							$thumbexists = true;
						}
						if(file_exists("images/Screens/$url") && $url!=""){						
							if($i == 1)$text .= "<tr>\n";
							$text .= "<td><a href='images/Screens/$url' class='screens' rel='screens'><img src='images/Screens/".(($thumbexists)?"thumbs/":"")."$url' width='".$conf['thumbwidth']."' class='border-0' /></a></td>\n";
							if($i == $conf['screensperrow']){$text .= "</tr>\n";$i=0;}
							$screens++;
							$i++;
						}
					}	
					
				if($screens < $conf['screensperrow']){
					$text .= "</tr>\n";
				}elseif($screens > $conf['screensperrow']){
					for($x=$i;$x<=$conf['screensperrow'];$x++){
						$text .= "<td></td>";
					}
					$text .= "</tr>";
				}
				
				$text .= "</table>\n</td></tr></table>";
    if($screens == 0) return '';
		return $text;	    
    }
     
     
   /**
   * {WAR_MAPS}
   *
   * @return string  
   */
    public function sc_war_maps()
    { 
    //todo time shortcut 
		extract($this->var);
 
		$conf = $this->conf;
 
    $maplinks =  $this->var['maps_data'] ;      
    $maps = " 
			<table width='100%' class='table fborder maps'>
				<tr>
					<td class='fcaption' colspan='".($conf['mapsperrow']*2)."'><div style='text-align: center;'><b>"._WMAPS."</b></div></td>
				</tr>";
					$i = 0;
					$imgs = 0;
 
						foreach ($maplinks AS $rowmap) {
              
							$i++;
							if($i == 1) $maps .= "<tr>";
							$maps .= "<td class='forumheader3' width='".$conf['mapwidth']."'>";
							$mapname = $rowmap['mapname'];
							$gametype = $rowmap['gametype'];
							$image = $rowmap['image']; 
              $maps .= $rowmap['maps'];
							$imgs++;
						 
							$maps .= "</td>
							<td class='forumheader3' data-image=$image style='padding:8px;'><b>$mapname</b> <br />$gametype</td>";
							if($i == $conf['mapsperrow']){
								$maps .= "</tr>";
								$i = 0;
							}
							
						}
			$maps .= "</table> ";
		  if($imgs == 0)  {
         return '';	  
      }
    $text = $maps;
    return $text;	    
    } 
	}
