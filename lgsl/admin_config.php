<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 LGSL Plugin credits: Richard Perry (www.greycube.com) + tltneon (https://github.com/tltneon)
 *
 * #######################################
 * #     e107 website system plugin      #
 * #     by Jimako                    	 #
 * #     https://www.e107sk.com          #
 * #######################################
 */

require_once '../../class2.php';
if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

// e107::lan('lgsl',true);

class lgsl_adminArea extends e_admin_dispatcher
{

	protected $modes = array(

		'main' => array(
			'controller' => 'lgsl_ui',
			'path' => null,
			'ui' => 'lgsl_form_ui',
			'uipath' => null,
		),

	);

	protected $adminMenu = array(

		//	'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),

		// 'main/div0'      => array('divider'=> true),
 		'main/custom' => array('caption' => 'Live Game Server List', 'perm' => 'P'),
		'main/prefs' => array('caption' => 'Settings', 'perm' => '0'),
		'main/links' => array('caption' => 'URL links', 'perm' => 'P'),

	);

	protected $adminMenuAliases = array(
		'main/edit' => 'main/list',
	);

	protected $menuTitle = 'LGSL e107 plugin';
}

class lgsl_ui extends e_admin_ui
{

	protected $pluginTitle = 'LGSL';
	protected $pluginName = 'lgsl';
	protected $preftabs = array('General Settings ', '[ ADVANCED SETTINGS ] ', '[ ZONE SIZING ]', '[ ZONE GRID ]', '[ ZONE PLAYERS]', '[ ZONE RANDOM ]', '[ ZONE OFFLINE]', '[ ZONE TIILES]', '[ HOSTING FIXES ]');

	protected $prefs = array(

		'style' => array('title' => 'Select Frontend  Style', 'tab' => 0, 'type' => 'dropdown', 'data' => 'string',
			'writeParms' => array('optArray' => array(
				'' => 'not use (let it fully on e107 theme )',
				'breeze_style.css' => 'LGSL SA Breeze Style',
				'darken_style.css' => 'LGSL SA Darken Style',
				'classic_style.css' => 'LGSL SA Classic Style',
				'ogp_style.css' => 'LGSL SA OGP Style',
				'parallax_style.css' => 'LGSL SA Parallax Style',
				'disc_ff_style.css' => 'LGSL SA Disc FF Style',
				'wallpaper_style.css' => 'LGSL SA Wallpaper Style',
				'material_style.css' => 'LGSL SA Material Style',

			))),

		'sort_servers_by' => array('title' => 'Sort Servers by', 'tab' => 0, 'type' => 'dropdown', 'data' => 'string', 'help' => '[ SORTING OPTIONS ]',
			'writeParms' => array('optArray' => array(
				'id' => 'ID',
				'type' => 'Type',
				'zone' => 'Zone',
				'players' => 'Players',
				'status' => 'Status'))),

		'sort_players_by' => array('title' => 'Sort Players by', 'tab' => 0, 'type' => 'dropdown', 'data' => 'string', 'help' => '[ SORTING OPTIONS ]',
			'writeParms' => array('optArray' => array(
				'name' => 'Name',
				'score' => 'Score',
				'time' => 'Time'))),

		'image_mod' => array('title' => 'Enable image mod', 'tab' => 0, 'type' => 'boolean', 'data' => 'integer', 'help' => '[ SHOW TOTAL SERVERS AND PLAYERS AT BOTTOM OF LIST: 0=OFF 1=ON ]'),

		'list_totals' => array('title' => 'Display Totals', 'type' => 'boolean', 'data' => 'integer', 'tab' => 0, 'help' => '[ SHOW TOTAL SERVERS AND PLAYERS AT BOTTOM OF LIST: 0=OFF 1=ON ]'),

		'locations' => array('title' => 'Display Locations', 'type' => 'dropdown', 'data' => 'string', 'tab' => 0, 'help' => '[ SHOW LOCATION FLAGS: 0=OFF 1=GEO-IP "GB"=MANUALLY SET COUNTRY CODE FOR SPEED ]'),

		'bootstrap3_table' => array('title' => 'Activate boostrap 3 tables behaviour', 'tab' => 0, 'type' => 'boolean', 'data' => 'integer', 'help' => 'Makes responsive bootstrap3 table'),
		'bootstrap3_imagefix' => array('title' => 'Use quick image fix', 'type' => 'boolean', 'tab' => 0, 'data' => 'integer', 'help' => 'Your theme should fix this too'),

		'management' => array('title' => 'Advanced management by default', 'tab' => 1, 'type' => 'boolean', 'data' => 'integer', 'help' => '[ 1/ON =show advanced management in the admin by default ]'), 'writeParms' => array('default' => 0),
		'host_to_ip' => array('title' => 'Show server IP', 'tab' => 1, 'type' => 'boolean', 'data' => 'integer', 'help' => '[ 1/ON =show the servers ip instead of its hostname ]'), 'writeParms' => array('default' => 0),
		'timeout' => array('title' => 'Timeout', 'tab' => 1, 'type' => 'boolean', 'data' => 'integer', 'help' => '[ 1/ON =gives more time for servers to respond but adds loading delay ]'), 'writeParms' => array('default' => 0),
		'retry_offline' => array('title' => 'Retry Offline', 'tab' => 1, 'type' => 'boolean', 'data' => 'integer', 'help' => '[ 1/ON = repeats query when there is no response but adds loading delay ]'), 'writeParms' => array('default' => 0),

		'cache_time' => array('title' => 'Cache Time', 'tab' => 1, 'type' => 'number',
			'writeParms' => array('default' => '60'), 'data' => 'integer', 'help' => ' seconds=time before a server needs updating '),

		'live_time' => array('title' => 'Live Time', 'tab' => 1, 'type' => 'number',
			'writeParms' => array('default' => '3'), 'data' => 'integer', 'help' => ' seconds=time allowed for updating servers per page load'),

		'zone_width' => array('title' => 'Zone Width', 'tab' => 2, 'type' => 'number', 'data' => 'integer',
			'writeParms' => array('default' => '160'),
			'help' => 'in pixels -  images will be cropped unless also resized to match'),

		'zone_line_size' => array('title' => 'Zone Line Size', 'tab' => 2, 'type' => 'number',
			'writeParms' => array('default' => '19'), 'data' => 'integer', 'help' => 'in pixels - player box height is this number multiplied by player names '),

		'zone_height' => array('title' => 'Zone Height', 'tab' => 2, 'type' => 'number', 'data' => 'integer',
			'writeParms' => array('default' => '100'), 'help' => 'in pixels -  player box height limit'),

		'zone_numbers' => array('title' => 'Zone Numbers', 'tab' => 2, 'type' => 'number',
			'writeParms' => array('default' => '8'), 'data' => 'integer', 'help' => 'Change, save, then edit other settings'),

		'zone_grid' => array('title' => "ZONE GRID ",
			'tab' => 3, 'help' => 'ZONE GRID: NUMBER=WIDTH OF GRID - INCREASE FOR HORIZONTAL ZONE STACKING',
			'type' => 'method', 'data' => 'json',
			'writeParms' => array(),
		),

		'zone_players' => array('title' => "Show Player names ",
			'tab' => 4, 'help' => 'ZONE SHOWS PLAYER NAMES: 0/OFF=HIDE 1/ON=SHOW',
			'type' => 'method', 'data' => 'json',
			'writeParms' => array(),
		),

		'zone_random' => array('title' => "MAX RANDOM SERVERS ",
			'tab' => 5, 'help' => 'ZONE RANDOMISATION: NUMBER=MAX RANDOM SERVERS TO BE SHOWN',
			'type' => 'method', 'data' => 'json',
			'writeParms' => array(),
		),

		'zone_hide_offline' => array('title' => "HIDE OFFLINE SERVERS ",
			'tab' => 6, 'help' => ' HIDE OFFLINE SERVERS: 0/OFF=HIDE 1/ON=SHOW',
			'type' => 'method', 'data' => 'json',
			'writeParms' => array(),
		),

		'zone_title' => array('title' => "List View Title + Zone titles ",
			'tab' => 7, 'help' => 'Titles inside zone used for caption too (depends on theme) . Caption can be changed in menu manager.',
			'type' => 'method', 'data' => 'json',
			'writeParms' => array(),
		),

		'direct_index' => array('title' => 'Direct index ', 'tab' => 8, 'type' => 'boolean',
			'writeParms' => array('default' => 1), 'data' => 'integer', 'help' => '1/ON =link to index.php instead of the folder '),

		'no_realpath' => array('title' => 'No realpath', 'tab' => 8, 'type' => 'boolean',
			'writeParms' => array('default' => 0), 'data' => 'integer', 'help' => '1/ON = do not use the realpath function '),

		'url_path' => array('title' => 'No realpath', 'tab' => 8, 'type' => 'text',
			'writeParms' => array('default' => '', 'size' => 'block-level'), 'data' => 'string', 'help' => ' full url to /lgsl_files/ for when auto detection fails '),

	);

	public function init()
	{

		$location[0] = "Disabled";
		$location[1] = "Auto-detect";
		$location['AD'] = "AD";
		$location['AE'] = "AE";
		$location['AF'] = "AF";
		$location['AG'] = "AG";
		$location['AI'] = "AI";
		$location['AL'] = "AL";
		$location['AM'] = "AM";
		$location['AN'] = "AN";
		$location['AO'] = "AO";
		$location['AR'] = "AR";
		$location['AS'] = "AS";
		$location['AT'] = "AT";
		$location['AU'] = "AU";
		$location['AW'] = "AW";
		$location['AX'] = "AX";
		$location['AZ'] = "AZ";
		$location['BA'] = "BA";
		$location['BB'] = "BB";
		$location['BD'] = "BD";
		$location['BE'] = "BE";
		$location['BF'] = "BF";
		$location['BG'] = "BG";
		$location['BH'] = "BH";
		$location['BI'] = "BI";
		$location['BJ'] = "BJ";
		$location['BM'] = "BM";
		$location['BN'] = "BN";
		$location['BO'] = "BO";
		$location['BR'] = "BR";
		$location['BS'] = "BS";
		$location['BT'] = "BT";
		$location['BV'] = "BV";
		$location['BW'] = "BW";
		$location['BY'] = "BY";
		$location['BZ'] = "BZ";
		$location['CA'] = "CA";
		$location['CC'] = "CC";
		$location['CD'] = "CD";
		$location['CF'] = "CF";
		$location['CG'] = "CG";
		$location['CH'] = "CH";
		$location['CI'] = "CI";
		$location['CK'] = "CK";
		$location['CL'] = "CL";
		$location['CM'] = "CM";
		$location['CN'] = "CN";
		$location['CO'] = "CO";
		$location['CR'] = "CR";
		$location['CS'] = "CS";
		$location['CU'] = "CU";
		$location['CV'] = "CV";
		$location['CX'] = "CX";
		$location['CY'] = "CY";
		$location['CZ'] = "CZ";
		$location['DE'] = "DE";
		$location['DJ'] = "DJ";
		$location['DK'] = "DK";
		$location['DM'] = "DM";
		$location['DO'] = "DO";
		$location['DZ'] = "DZ";
		$location['EC'] = "EC";
		$location['EE'] = "EE";
		$location['EG'] = "EG";
		$location['EH'] = "EH";
		$location['ER'] = "ER";
		$location['ES'] = "ES";
		$location['ET'] = "ET";
		$location['EU'] = "EU";
		$location['FI'] = "FI";
		$location['FJ'] = "FJ";
		$location['FK'] = "FK";
		$location['FM'] = "FM";
		$location['FO'] = "FO";
		$location['FR'] = "FR";
		$location['GA'] = "GA";
		$location['GB'] = "GB";
		$location['GD'] = "GD";
		$location['GE'] = "GE";
		$location['GF'] = "GF";
		$location['GH'] = "GH";
		$location['GI'] = "GI";
		$location['GL'] = "GL";
		$location['GM'] = "GM";
		$location['GN'] = "GN";
		$location['GP'] = "GP";
		$location['GQ'] = "GQ";
		$location['GR'] = "GR";
		$location['GS'] = "GS";
		$location['GT'] = "GT";
		$location['GU'] = "GU";
		$location['GW'] = "GW";
		$location['GY'] = "GY";
		$location['HK'] = "HK";
		$location['HM'] = "HM";
		$location['HN'] = "HN";
		$location['HR'] = "HR";
		$location['HT'] = "HT";
		$location['HU'] = "HU";
		$location['ID'] = "ID";
		$location['IE'] = "IE";
		$location['IL'] = "IL";
		$location['IN'] = "IN";
		$location['IO'] = "IO";
		$location['IQ'] = "IQ";
		$location['IR'] = "IR";
		$location['IS'] = "IS";
		$location['IT'] = "IT";
		$location['JM'] = "JM";
		$location['JO'] = "JO";
		$location['JP'] = "JP";
		$location['KE'] = "KE";
		$location['KG'] = "KG";
		$location['KH'] = "KH";
		$location['KI'] = "KI";
		$location['KM'] = "KM";
		$location['KN'] = "KN";
		$location['KP'] = "KP";
		$location['KR'] = "KR";
		$location['KW'] = "KW";
		$location['KY'] = "KY";
		$location['KZ'] = "KZ";
		$location['LA'] = "LA";
		$location['LB'] = "LB";
		$location['LC'] = "LC";
		$location['LI'] = "LI";
		$location['LK'] = "LK";
		$location['LR'] = "LR";
		$location['LS'] = "LS";
		$location['LT'] = "LT";
		$location['LU'] = "LU";
		$location['LV'] = "LV";
		$location['LY'] = "LY";
		$location['MA'] = "MA";
		$location['MC'] = "MC";
		$location['MD'] = "MD";
		$location['ME'] = "ME";
		$location['MG'] = "MG";
		$location['MH'] = "MH";
		$location['MK'] = "MK";
		$location['ML'] = "ML";
		$location['MM'] = "MM";
		$location['MN'] = "MN";
		$location['MO'] = "MO";
		$location['MP'] = "MP";
		$location['MQ'] = "MQ";
		$location['MR'] = "MR";
		$location['MS'] = "MS";
		$location['MT'] = "MT";
		$location['MU'] = "MU";
		$location['MV'] = "MV";
		$location['MW'] = "MW";
		$location['MX'] = "MX";
		$location['MY'] = "MY";
		$location['MZ'] = "MZ";
		$location['NA'] = "NA";
		$location['NC'] = "NC";
		$location['NE'] = "NE";
		$location['NF'] = "NF";
		$location['NG'] = "NG";
		$location['NI'] = "NI";
		$location['NL'] = "NL";
		$location['NO'] = "NO";
		$location['NP'] = "NP";
		$location['NR'] = "NR";
		$location['NU'] = "NU";
		$location['NZ'] = "NZ";
		$location['OFF'] = "OFF";
		$location['OM'] = "OM";
		$location['PA'] = "PA";
		$location['PE'] = "PE";
		$location['PF'] = "PF";
		$location['PG'] = "PG";
		$location['PH'] = "PH";
		$location['PK'] = "PK";
		$location['PL'] = "PL";
		$location['PM'] = "PM";
		$location['PN'] = "PN";
		$location['PR'] = "PR";
		$location['PS'] = "PS";
		$location['PT'] = "PT";
		$location['PW'] = "PW";
		$location['PY'] = "PY";
		$location['QA'] = "QA";
		$location['RE'] = "RE";
		$location['RO'] = "RO";
		$location['RS'] = "RS";
		$location['RU'] = "RU";
		$location['RW'] = "RW";
		$location['SA'] = "SA";
		$location['SB'] = "SB";
		$location['SC'] = "SC";
		$location['SD'] = "SD";
		$location['SE'] = "SE";
		$location['SG'] = "SG";
		$location['SH'] = "SH";
		$location['SI'] = "SI";
		$location['SJ'] = "SJ";
		$location['SK'] = "SK";
		$location['SL'] = "SL";
		$location['SM'] = "SM";
		$location['SN'] = "SN";
		$location['SO'] = "SO";
		$location['SR'] = "SR";
		$location['ST'] = "ST";
		$location['SV'] = "SV";
		$location['SY'] = "SY";
		$location['SZ'] = "SZ";
		$location['TC'] = "TC";
		$location['TD'] = "TD";
		$location['TF'] = "TF";
		$location['TG'] = "TG";
		$location['TH'] = "TH";
		$location['TJ'] = "TJ";
		$location['TK'] = "TK";
		$location['TL'] = "TL";
		$location['TM'] = "TM";
		$location['TN'] = "TN";
		$location['TO'] = "TO";
		$location['TR'] = "TR";
		$location['TT'] = "TT";
		$location['TV'] = "TV";
		$location['TW'] = "TW";
		$location['TZ'] = "TZ";
		$location['UA'] = "UA";
		$location['UG'] = "UG";
		$location['UM'] = "UM";
		$location['US'] = "US";
		$location['UY'] = "UY";
		$location['UZ'] = "UZ";
		$location['VA'] = "VA";
		$location['VC'] = "VC";
		$location['VE'] = "VE";
		$location['VG'] = "VG";
		$location['VI'] = "VI";
		$location['VN'] = "VN";
		$location['VU'] = "VU";
		$location['WF'] = "WF";
		$location['WS'] = "WS";
		$location['YE'] = "YE";
		$location['YT'] = "YT";
		$location['ZA'] = "ZA";
		$location['ZM'] = "ZM";
		$location['ZW'] = "ZW";
		$this->prefs['locations']['writeParms']['optArray'] = $location;
	}

	public function renderHelp()
	{
		$tp = e107::getParser();
		$hide_help = e107::getPlugConfig('simplepage')->getPref('hide_help');
		if ($hide_help)
		{
			return '';
		}
		$text =
		'<ul class="list-unstyled text-center">
			<li><b>LGSL</b></li>
			<li><a href="https://github.com/tltneon/lgsl">[ LGSL GITHUB ]</a></li>
			<li><a target="_blank" href="https://github.com/tltneon/lgsl/wiki">[ LGSL ONLINE WIKI ]</a></li>
			<li><b>e107 LGSL Plugin</b></li>
			<li>Live Game Server List for e107</li>
			<li><a href="https://www.e107sk.com/">[ e107 SUPPORT ]</a></li>

			<li class="text-center">
				<p><small>Thank you</small>'.e107::getParser()->toGlyph('fa-smile-o').'</p>
			</li>
		</ul> ';

		return array('caption' => "e107 LGSL plugin", 'text' => $text);
	}

	public function customPage()
	{
		define("LGSL_ADMIN", "1");
		$output = "<div class='lgsl table-responsive'>";
		require "lgsl_files/lgsl_admin.php";
		$output .= "</div>";
		e107::getRender()->tablerender('', $output);
		$output = "";

	}

	public function linksPage()
	{

		$output = "<div class='lgsl table-responsive'>";
		$output .= 'SITEURL: <pre>' . SITEURL . '</pre>';
		$link = e107::url('lgsl', 'index');
		$output .= 'SEF URL (you can change alias/name in URL configuration): <pre>' . $link . '</pre>';
		$link = e_PLUGIN . "lgsl/index.php";
		$output .= 'LEGACY URLs  : <pre>' . $link . '</pre>';
		$link = e_PLUGIN_ABS . "lgsl/index.php";
		$output .= 'LEGACY URLs  : <pre>' . $link . '</pre>';
		$link = e107::url('lgsl', 'detail', array('query_path' => '?s=1'));
		$output .= 'SEF URL DETAIL s=1: <pre>' . $link . '</pre>';
		$link = e_PLUGIN . "lgsl/index.php?s=1";
		$output .= 'LEGACY URLs  : <pre>' . $link . '</pre>';
		
		//result of lgsl_url_path()
		$link = $this->lgsl_url_path();
		$output .= 'LGSL URL PATH (simulated) : <pre>' . $link . '</pre>';
		$output .= "</div>";
		e107::getRender()->tablerender('', $output);
		$output = "";

	}

	//simulation, check lgsl_class.php
	public function lgsl_url_path()
	{
		// CHECK IF PATH HAS BEEN SET IN CONFIG

		$lgsl_config = e107::pref('lgsl');

		if ($lgsl_config['url_path'])
		{
			return $lgsl_config['url_path'];
		}

		// USE FULL DOMAIN PATH TO AVOID ALIAS PROBLEMS

		$host_path = (!isset($SERVER['HTTPS']) || strtolower($SERVER['HTTPS']) != "on") ? "http://" : "https://";
		$host_path .= $SERVER['HTTP_HOST'];

		// GET FULL PATHS ( EXTRA CODE FOR WINDOWS AND IIS - NO DOCUMENT_ROOT - BACKSLASHES - DOUBLESLASHES - ETC )

		if ($SERVER['DOCUMENT_ROOT'])
		{
			$base_path = $this->lgsl_realpath($SERVER['DOCUMENT_ROOT']);
			$base_path = str_replace("\\", "/", $base_path);
			$base_path = str_replace("//", "/", $base_path);
		}
		else
		{
			$file_path = $SERVER['SCRIPT_NAME'];
			$file_path = str_replace("\\", "/", $file_path);
			$file_path = str_replace("//", "/", $file_path);

			$base_path = $SERVER['PATH_TRANSLATED'];
			$base_path = str_replace("\\", "/", $base_path);
			$base_path = str_replace("//", "/", $base_path);
			$base_path = substr($base_path, 0, -strlen($file_path));
		}

		$lgsl_path = dirname($this->lgsl_realpath(__FILE__));
		$lgsl_path = str_replace("\\", "/", $lgsl_path);

		// REMOVE ANY TRAILING SLASHES

		if (substr($base_path, -1) == "/")
		{
			$base_path = substr($base_path, 0, -1);}
		if (substr($lgsl_path, -1) == "/")
		{
			$lgsl_path = substr($lgsl_path, 0, -1);}

		// USE THE DIFFERENCE BETWEEN PATHS

		if (substr($lgsl_path, 0, strlen($base_path)) == $base_path)
		{
			$url_path = substr($lgsl_path, strlen($base_path));

			return $host_path . $url_path . "/";
		}

		return "/#LGSL_PATH_PROBLEM#{$base_path}#{$lgsl_path}#/";
	}

	public function lgsl_realpath($path)
	{
		// WRAPPER SO IT CAN BE DISABLED
		global $lgsl_config;
		return $lgsl_config['no_realpath'] ? $path : realpath($path);
	}
}

class lgsl_form_ui extends e_admin_form_ui
{
	public function zone_grid($curVal, $mode)
	{

		$value = array();
		$text = '';

		if (!empty($curVal))
		{
			$value = e107::unserialize($curVal);
		}
		$zone_number = e107::pref('lgsl', 'zone_numbers', 8);

		$text = "<table class='table table-condensed table-bordered'  style='table-element: fixed;' ><tbody> ";

		$nameitem = 'zone_grid';

		for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++)
		{
			$field = array(
				'title' => 'Grid[' . $fieldkey . ']',
				'type' => 'number',
				'data' => 'int',
				'writeParms' => array('default' => 1),
			);
			$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
			$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
			$text .= "</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;

	}

	public function zone_players($curVal, $mode)
	{

		$value = array();
		$text = '';

		if (!empty($curVal))
		{
			$value = e107::unserialize($curVal);
		}
		$zone_number = e107::pref('lgsl', 'zone_numbers', 8);

		$text = "<table class='table table-condensed table-bordered'  style='table-element: fixed;' ><tbody> ";

		$nameitem = 'zone_players';

		for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++)
		{
			$field = array(
				'title' => 'Players[' . $fieldkey . ']',
				'type' => 'boolean',
				'data' => 'int',
			);
			$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
			$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
			$text .= "</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;
	}

	public function zone_random($curVal, $mode)
	{

		$value = array();
		$text = '';

		if (!empty($curVal))
		{
			$value = e107::unserialize($curVal);
		}
		$zone_number = e107::pref('lgsl', 'zone_numbers', 8);

		$text = "<table class='table table-condensed table-bordered'  style='table-element: fixed;' ><tbody> ";

		$nameitem = 'zone_random';

		for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++)
		{
			$field = array(
				'title' => 'Random[' . $fieldkey . ']',
				'type' => 'number',
				'data' => 'int',
				'writeParms' => array('default' => 0),
			);
			$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
			$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
			$text .= "</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;

	}

	public function zone_hide_offline($curVal, $mode)
	{

		$value = array();
		$text = '';

		if (!empty($curVal))
		{
			$value = e107::unserialize($curVal);
		}
		$zone_number = e107::pref('lgsl', 'zone_numbers', 8);

		$text = "<table class='table table-condensed table-bordered'  style='table-element: fixed;' ><tbody> ";

		$nameitem = 'zone_hide_offline';

		for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++)
		{
			$field = array(
				'title' => 'Hide Offline[' . $fieldkey . ']',
				'type' => 'boolean',
				'data' => 'int',
			);
			$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
			$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
			$text .= "</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;
	}

	public function zone_title($curVal, $mode)
	{

		$value = array();
		$text = '';

		if (!empty($curVal))
		{
			$value = e107::unserialize($curVal);
		}
		$zone_number = e107::pref('lgsl', 'zone_numbers', 8);

		$text = "<table class='table table-condensed table-bordered'  style='table-element: fixed;' ><tbody> ";

		$nameitem = 'zone_title';

		$fieldkey = 0;
		$field = array(
			'title' => 'List View Title[' . $fieldkey . ']',
			'type' => 'text',
			'data' => 'string',
			'writeParms' => array('default' => 'Live Game Server List'),
		);
		$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
		$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
		$text .= "</td></tr>";

		for ($fieldkey = 1; $fieldkey <= $zone_number; $fieldkey++)
		{
			$field = array(
				'title' => 'Zone Titles[' . $fieldkey . ']',
				'type' => 'text',
				'data' => 'string',
				'writeParms' => array('default' => 'Game Server'),
			);
			$text .= "<tr><td width=20%>" . $field['title'] . ": </td><td>";
			$text .= $this->renderElement($nameitem . '[' . $fieldkey . ']', $value[$fieldkey], $field);
			$text .= "</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;
	}
}

new lgsl_adminArea();

require_once e_ADMIN . "auth.php";
e107::getAdminUI()->runPage();

require_once e_ADMIN . "footer.php";
exit;
