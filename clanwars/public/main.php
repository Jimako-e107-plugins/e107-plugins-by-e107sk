<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "main.php")) {
    die ("You can't access this file directly...");
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
$tp = e107::getParser();
/******  REPLACE OLD GLOBALS END  *********************************************/

?>
 
<script type="text/javascript">
<?php if($conf['enablemail'] && $conf['allowsubscr'] && cansubscribe()){ ?>
var username = "<?php echo USERNAME;?>";
var is_user = <?php echo ((USER) ? "true" : "false" ). ";\n";?>
var emailact = <?php echo (($conf['emailact']) ? "true" : "false" ). ";\n";?>
//LANG
var sureunsubscr = "<?php echo _WSUREUNSUBSCR;?>";
var unsubops = "<?php echo _WUNSUBOPS;?>";
var mailremoved = "<?php echo _WMAILREMOVED;?>";
var errorunsub = "<?php echo _WERRORUNSUB;?>";
var subscr = "<?php echo _WSUBSCR;?>";
var emaildeact = "<?php echo _WEMAILDEACT;?>";
var reactmail = "<?php echo _WREACTMAIL;?>";
var emailisreact = "<?php echo _WEMAILISREACT;?>";
var unsub = "<?php echo _WUNSUB;?>";
var errorreact = "<?php echo _WERRORREACT;?>";
var enteremail = "<?php echo _WENTEREMAIL;?>";
var entervalid = "<?php echo _WENTERVALID;?>";
var alrsubscr = "<?php echo _WALRSUBSCR;?>";
var emailinlist = "<?php echo _WEMAILINLIST;?>";
var emailsent = "<?php echo _WEMAILSENT;?>";
var aresubscr = "<?php echo _WARESUBSCR;?>";
//END LANG
<?php } ?>

function ShowFilterOps(){
	document.getElementById('filterops').style.display = "block";
}
function CloseFilterOps(){
	document.getElementById('filterops').style.display = "none";
}
function TdHover(id){
	var tds = document.getElementById('war'+id).getElementsByTagName('td');
	for(var i = 0;i<tds.length;i++){
		tds[i].className = 'forumheader3';
	}
}
function TdOut(id){
	var tds = document.getElementById('war'+id).getElementsByTagName('td');
	for(var i = 0;i<tds.length;i++){
		tds[i].className = 'forumheader3';
	}
}
</script>
<?php
$text = "";
if($conf['enablemail'] && $conf['allowsubscr'] && cansubscribe()){
	$text = '<script type="text/javascript" src="includes/main-mail.js"></script>';
}

	if (!isset($min)) $min = 0;
	if(canaddwars()) $text .= "<a class='button btn btn-admin' href='clanwars.php?AddWar' style='font-size:10px;'>"._WADDNEWWAR."</a><br />&nbsp;";
	
	$totalwars = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1'");	
	if($totalwars==0){
		$text .= "<br /><br /><div class='text-center'>"._WNOWARSYET."</div><br /><br />";
	}else{	
  

  
	

	
	//Filters
	$orderby = $tp->toDB($_REQUEST['orderby']);
	$sortby = $tp->toDB($_REQUEST['sortby']);
	if($orderby==""){$orderby=_WDESC;}
	if($sortby==""){$sortby=_WDATE;}
		
	$wheresql = "";
	$pagefilters = "";
	$selstatus = $tp->toDB($_REQUEST['selstatus']);
	$selgid = intval($_REQUEST['selgid']);
	$seltid = intval($_REQUEST['seltid']);
	$selstyle = $tp->toDB($_REQUEST['selstyle']);
	if($selstatus == "1"){
		$wheresql .= " AND status='1'";
		$pagefilters .= "&selstatus=1";
	}elseif($selstatus == "0"){
		$wheresql .= " AND status='0'";
		$pagefilters .= "&selstatus=0";
	}if($_REQUEST['selgid']>0){
		$wheresql .= " AND game='$selgid'";			
		$pagefilters .= "&selgid=".$selgid;
	}if($_REQUEST['seltid']>0){
		$wheresql .= " AND team='$seltid'";			
		$pagefilters .= "&seltid=".$seltid;
	}if($_REQUEST['selstyle'] !="" && $selstyle !=_WALL){
		$wheresql .= " AND style='$selstyle'";			
		$pagefilters .= "&selstyle=".$selstyle;
	}

	$nrwars = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1' $wheresql");		
	$win = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1' AND our_score > opp_score AND status='1'");
	$lose = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1' AND  opp_score > our_score AND status='1'");
	$draw = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1' AND  opp_score = our_score AND status='1'");		
	$upcomming = e107::getDb()->count("clan_wars", "(*)", "WHERE active='1' AND  status='0'");
 


  

  
/* Calculate how many pages exist.... */
$min = intval($_GET['min']);
$warspages = ceil($nrwars / $conf['rowsperpage']);
if($warspages <= 1){
	$pagenumbering = "";
}else{
	$pagenumbering = _WSPAGE.": ";
	$counter = 1;
	$currentpage = ($min + $conf['rowsperpage']) / $conf['rowsperpage'];
		while ($counter<=$warspages ) {
			$cpage = $counter;
			$mintemp = ($conf['rowsperpage'] * $counter) - $conf['rowsperpage'];
			if ($counter == $currentpage) {           
				$pagenumbering .= '<a  class="active disabled" href="#" onclick="return false;" <b>'.$counter.'</b></a>';
			} else {
			$pagenumbering .= "<a href='clanwars.php?Main&min=$mintemp&sortby=$sortby&orderby=$orderby$pagefilters'>$counter</a> ";
			}
			$counter++;
		}
}

	/* Page Numbering */
	if($warspages > 1){
	$textpagenumbering  = "
			<tr>
				<td class='nowrap pagenumbering '>$pagenumbering</td>   
			</tr>";			
	}
  
  // wars page starts
	$text .= "<div class='warfilters'>
     <table class='table'>";
       $text .= $textpagenumbering;
		$text .= "<tr>
		<td class='nowrap text-center'>";
		$teams = e107::getDB()->count("clan_teams");

//Ordering
		$text .= "<b><a href='javascript:ShowFilterOps();'>"._WFILTEROPS." <img src='images/ArrowDown".$conf['arrowcolor'].".png' class='border-0'></a></b>";
		$sortoptions = array(_WDATE, _WGAME, _WTEAM, _WOPP, _WSTYLE, _WPLAYERS);
		if(!$teams) $sortoptions[2] = "";
		$text .= "<div class='filterops forumheader3' id='filterops'><b><a href='javascript:CloseFilterOps();'>"._WCLOSOPS." <img src='images/ArrowUp".$conf['arrowcolor'].".png' class='border-0'></a></b><br />
		<form method='post' action='clanwars.php'>
			<table class='tableordering table'>
				<tr>
					<td>"._WSTATUS.": </td>
					<td>
            <select name='selstatus' >
						<option>"._WALL."</option>
						<option value='0' ".(($selstatus == "0") ? "selected" :"").">"._WUPCOMM."</option>
						<option value='1' ".(($selstatus == "1") ? "selected" :"").">"._WFIN."</option>
					</select></td>
				</tr>
				<tr>
					<td>"._WORDER.": </td>
					<td class='nowrap'><select name='sortby' >";
			for($i=0;$i<count($sortoptions);$i++){
				if($sortoptions[$i] !=""){
					$text .= "<option ".(($sortoptions[$i]==$sortby)?"selected":"").">".$sortoptions[$i]."</option>";
				}
			}
			$text .= "</select>&nbsp;<select name='orderby' >
						<option value='"._WASC."' ".(($orderby==_WDESC)?"":"selected").">"._WASC."</option>
						<option value='"._WDESC."' ".(($orderby==_WDESC)?"selected":"").">"._WDESC."</option>
					</select></td>
				</tr>
				<tr>
					<td>"._WSTYLE.": </td>
					<td><select name='selstyle'>
							<option>"._WALL."</option>";
              
					$result = $sql->retrieve("clan_wars", "style",  "style!='' GROUP BY style ORDER BY style ASC", true);
 
						foreach($result as $row){
						 $style = $row['style'];
						$text .= "<option ".(($style==$selstyle)?"selected":"").">$style</option>";
						}
			$text .= "</select></td>
				</tr>
				<tr>
					<td>"._WGAME.": </td>
					<td><select name='selgid' >
							<option value='0'>"._WALL."</option>";
					$result = $sql->retrieve("clan_games", "*", "inwars='1' ORDER BY gname ASC", true);
						foreach($result as $row){
							$gid = $row['gid'];
							$gname = $row['gname'];
						$text .= "<option value='$gid' ".(($gid==$selgid)?"selected":"").">$gname</option>";
						}
			$text .= "</select></td>
				</tr>";
			if($teams){
			$text .= "<tr>
					<td>"._WTEAM.": </td>
					<td><select name='seltid'>
							<option value='0'>"._WALL."</option>";
					$result = $sql->retrieve("clan_teams", "*", "inwars='1' ORDER BY team_name ASC", true);
						foreach($result as $row){
							$tid = $row['tid'];
							$team_name = $row['team_name'];
							$text .= "<option value='$tid' ".(($tid==$seltid)?"selected":"").">$team_name</option>";
						}
			$text .= "</select></td>
				</tr>";
			}
			$text .= "
				<tr>
					<td></td>
					<td class='text-right'><input type='submit' class='button btn' value='"._WAPPLYFILTERS."' /></td>
				</tr>
			</table>
			</form></div>";
		
		$text .= "</td></tr></table></div>";		

$tables = "";
if($orderby==_WDESC && $sortby==_WDATE){$ordersort="wardate DESC";}
elseif($orderby==_WASC && $sortby==_WDATE){$ordersort="wardate ASC";}
elseif($orderby==_WDESC && $sortby==_WGAME){
	$ordersort="g.gname DESC, wardate DESC";
	$tables = ", #clan_games as g";
	$wheresql .= " AND game=g.gid";
}elseif($orderby==_WASC && $sortby==_WGAME){
	$ordersort="g.gname ASC, wardate DESC";
	$tables = ", #clan_games as g";
	$wheresql .= " AND game=g.gid";
}elseif($orderby==_WDESC && $sortby==_WTEAM){
	$ordersort="t.team_tag DESC, wardate DESC";
	$tables = ", #clan_teams as t";
	$wheresql .= " AND team=t.tid";
}elseif($orderby==_WASC && $sortby==_WTEAM){
	$ordersort="t.team_tag ASC, wardate DESC";
	$tables = ", #clan_teams as t";
	$wheresql .= " AND team=t.tid";
}elseif($orderby==_WDESC && $sortby==_WOPP){$ordersort="opp_tag DESC, wardate DESC";}
elseif($orderby==_WASC && $sortby==_WOPP){$ordersort="opp_tag ASC, wardate DESC";}
elseif($orderby==_WDESC && $sortby==_WSTYLE){$ordersort="style DESC, wardate DESC";}
elseif($orderby==_WASC && $sortby==_WSTYLE){$ordersort="style ASC, wardate DESC";}
elseif($orderby==_WDESC && $sortby==_WPLAYERS){$ordersort="players DESC, wardate DESC";}
elseif($orderby==_WASC && $sortby==_WPLAYERS){$ordersort="players ASC, wardate DESC";}

		
	$text .= "
  <div class='table-responsive'>
  <table class='table table-striped table-bordered table-hover fborder'   id='warstable'>
		<tr>
			<th class='nowrap fcaption'></th>
			<th class='nowrap fcaption'><b>"._WDATE."</b></th>";
			if($teams) $text .= "<th class='nowrap fcaption'><b>"._WTEAM."</b></th>";
			$text .= "<th class='nowrap fcaption'><b>"._WOPP."</b></th>
			<th class='nowrap fcaption'><b>"._WSTYLE."</b></th>
			<th class='nowrap fcaption'><b>"._WPLAYERS."</b></th>
			<th class='nowrap fcaption'><b>"._WRESULTS."</b></th>
		</tr>";
	
	$upcshown = false;
	$finshown = false;
	$wars = $sql->retrieve("SELECT * from #clan_wars $tables WHERE active='1' $wheresql ORDER BY ".($conf['seperate']?"status ASC,":"")." $ordersort LIMIT $min , ".$conf['rowsperpage'], true);
   	if(!$wars){
			$text .= "<tr><td class='forumheader3' colspan='".(($teams) ? 7 : 6)."'>There are no wars to be displayed</td></tr>";
		}
 
	foreach($wars as $row){ 
     
			$wid = $row['wid'];
			$wardate = $row['wardate'];
			$style = $row['style'];
			$status = $row['status'];
			$team = $row['team'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$game = $row['game'];
			$players = $row['players'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
       
			if($conf['seperate'] && ($selstatus == _WALL || $selstatus == "")){
				if(!$upcshown && !$status){
					$text .= "<tr><td class='fcaption' colspan='".(($teams) ? 7 : 6)."'><b>Upcoming Matches</b></td></tr>";
					$upcshown = true;
				}
				if(!$finshown && $upcshown && $status){
					$text .= "<tr><td class='fcaption' colspan='".(($teams) ? 7 : 6)."'><b>Finished Matches</b></td></tr>";
					$finshown = true;
				}
 	}
			
			if (strlen($opp_name) > 30){
				$opp_name = substr($opp_name, 0, 30 - 3)."..."; 
			}					

		$text .= "<tr class='forumheader3 iconpointer' title='Show Match Details' onmouseover=\"TdHover($wid);\" onmouseout=\"TdOut($wid);\" onclick=\"window.location='clanwars.php?Details&wid=$wid'\" id='war$wid'>
					<td class='nowrap forumheader3'>";	
								
	  $rowicon = e107::getDb()->retrieve("clan_games", "*", "gid='$game'");
 
		$icon = $rowicon['icon'];
		$abbr = $rowicon['abbr'];
		$gname = $rowicon['gname'];
			if ($icon != "") {
				$text .= "<img src='".e_IMAGE."clan/games/$icon' title='$gname' class='absmiddle border-0'  alt='".($abbr?$abbr:$gname)."' />";
			}else{
				$text .= ($abbr?$abbr:$gname);
			}
			$text .= "</td>";
			$text .= "<td class='nowrap forumheader3'>".(($wardate == -1) ? "" : date($conf['formatlist'],$wardate))."</td>";
			$row = e107::getDb()->retrieve("clan_teams", "*", "tid='$team'");
      $team_tag =  $row['team_tag'];	
			if($teams){
				if($conf['showteamflag']){
					$team_country = $row['team_country'];			
					$text .= "<td class='nowrap forumheader3' style='text-align:left;'><img src='".e_IMAGE."clan/flags/$team_country.png' title='$team_country'/>&nbsp;$team_tag</td>";
				}else{
					$text .= "<td class='nowrap forumheader3'>$team_tag</td>";
				}
			}
			$text .= "<td class='nowrap forumheader3 width-50 text-left'> &nbsp;<img src='".e_IMAGE."clan/flags/$opp_country.png'   title='$opp_country' class='absmiddle border-0' />&nbsp;";
			
			if($opp_tag !=""){$text .= $opp_tag;}else{$text .= $opp_name;}			

			$text .= "</td>
			<td class='nowrap forumheader3'>$style</td>
			<td class='nowrap forumheader3'>".((intval($players)) ? $players._WON.$players : "N/A")."</td>";
			
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
					$text .= "<td class='nowrap forumheader3' style='background:$scorecolor;'><b style='color: #FFF;'>$our_score/$opp_score</b></td>";
				}else{
					//Colored Text					
					$text .= "<td class='nowrap forumheader3'><b style='color: $scorecolor;'>$our_score/$opp_score</b></td>";			
				}
			}else{
				//No score
				$text .= "<td class='nowrap forumheader3'><b>N/A</b></td>";
			}
			
			$text .= "</tr>";
		}
		$text .= "</table>";
		
	/* Page Numbering */
	if($warspages > 1){
	$text .= "<table class='table'>
			<tr>
				<td class='nowrap pagenumbering '>$pagenumbering</td>
			</tr>
		</table></div>";			
	}
	if($conf['warssummary']){
		$text .= "<div class='text-center'><br /><b>$totalwars</b> "._WARS.": <b>
		<span style='color:#009900;'>$win</span></b> "._WWON." - <b><span style='color:#990000;'>$lose</span></b> "._WLOST." - <b>
		<span style='color:#3333FF;'>$draw</span></b> "._WDRAW." - <b>$upcomming</b> "._WUPCOM."</div>";
	}
}

//Wars-Mail
if($conf['enablemail'] && $conf['allowsubscr'] && cansubscribe()){
	$text .= "<div id='warsmaildiv' class='text-center'><br />";
  $row =e107::getDb()->retrieve("clan_wars_mail", "*", "member='".USERID."'");
 
	if($row =e107::getDb()->retrieve("clan_wars_mail", "*", "member='".USERID."'")) {			 
			if($row['active'] == 1 or $row['code'] != ""){
				$text .= "<a href='javascript:Unsubscribe();'>"._WUNSUB."</a>";
			}else{
				$text .= "<a href='javascript:Subscribe(1);'>"._WREACTMAIL."</a>";
			}
		} else{
			$text .= "<a href='javascript:Subscribe(0);'>"._WSUBSCR."</a>";
		}
	$text .= "<br /></div>";
}

$ns->tablerender(_CLANWARS, $text);

?>