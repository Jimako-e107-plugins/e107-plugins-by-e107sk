<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - e_Module
 *
 * $Id: e_module.php 502 2009-06-19 09:51:36Z secretr $
*/
if (!defined("e107_INIT")) exit;

require_once(e_PLUGIN.'clanforum/clanforum_defines.php');
 
 
e107_require_once(CLAN_FORUM_APP.'handlers/e_parse_class.php');
$oldtp = new old_e_parse;
