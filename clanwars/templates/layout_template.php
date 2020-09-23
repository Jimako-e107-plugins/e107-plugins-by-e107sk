<?php
 
//$CLANWARS_WRAPPER['detail']['SHORTCODE_NAME'] = "(html before){---}(html after)"; 
$LAYOUT_WRAPPER['details']['WAR_OPPONENT'] = "<div class='col-md-4 col-sm-6'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_OTHER'] = "<div class='col-md-4 col-sm-6'>{---}</div>"; 
$LAYOUT_WRAPPER['details']['WAR_MATCH'] = "<div class='col-md-4 col-sm-6'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_RESULTSBYMAP'] = "<div class='col-md-4 col-sm-6'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_SERVER']    = "<div class='col-md-4 col-sm-6'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_REPORT']    = "<div class='col-md-4 col-sm-6'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_LINEUP']    = "<div class='col-md-6 col-sm-12'>{---}</div>";
$LAYOUT_WRAPPER['details']['WAR_MAPS']      = "<div class='row row-clanwars '><div class='col-md-12'>{---}</div></div>";
$LAYOUT_WRAPPER['details']['WAR_SCREENS']   = "<div class='row row-clanwars '><div class='col-md-12'>{---}</div></div>";

$LAYOUT_WRAPPER['details']['WAR_COMMENTS'] = "<div class='col-md-6 col-sm-12'>{---}</div>";

$LAYOUT_TEMPLATE['details']['caption'] =  ' {WAR_CAPTION} ';

$LAYOUT_TEMPLATE['details']['body'] =   "<a href='clanwars.php' style='font-size:10px;'>"._WRETURNLIST."</a><br /><div class='text-center'>" ;														
$LAYOUT_TEMPLATE['details']['body'] .=   "<div class='row row-clanwars '>" ; 
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_MATCH}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_OPPONENT}" ; 
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_OTHER}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_RESULTSBYMAP}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_SERVER}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_REPORT}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "</div>{WAR_SCREENS} " ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_MAPS}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "<div class='row row-clanwars '>{WAR_LINEUP}" ;
$LAYOUT_TEMPLATE['details']['body'] .=   "{WAR_COMMENTS}";
$LAYOUT_TEMPLATE['details']['body'] .=   "</div>" ; 
$LAYOUT_TEMPLATE['details']['body'] .=   "</div>" ;