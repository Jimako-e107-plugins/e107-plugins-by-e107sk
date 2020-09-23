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

if (e_CURRENT_PLUGIN == 'lgsl')
{
	// e107::css('lgsl', 'lgsl_files/styles/darken_style.css');
	// original css files have conflicts with e107 admin styles
	$e107_prefs = e107::pref('lgsl');
	if (ADMIN_AREA)
	{
		/* v 5.8 */
		$inline_script = "";
		$css .= "
          table input.form-control, table textarea.form-control, table select.form-control {
              width: 100%;
              max-width: 245px;
          }

          .table-responsive {
              display: block;
              width: 100%;
              overflow-x: auto;
              -webkit-overflow-scrolling: touch;
          }

          .table {
              width: 100%;
              margin-bottom: 1rem;
          }";

		$start = "$(document).ready(function() {";
		$end = "});	";
		$inline_script .= "
        $('.lgsl form div table:nth-child(1)').addClass('table adminlist table-striped table-1');
        $('.lgsl form div table:nth-child(3)').addClass('table table-2');

        $('.lgsl div ').addClass('div-1');

        $('.lgsl>div>table ').addClass('table  table-striped table-5');
        $('.lgsl>form>div>table  td input:submit ').addClass('btn btn-primary');";

		if (e107::getPref('admincss') == "css/kadmin.css")
		{
			$inline_script .= "
            $('.lgsl table td ').addClass('tbox');
            $('.lgsl table td input ').addClass('form-control');";
		}
		e107::css('inline', $css);
		e107::js('inline', $start . $inline_script . $end);
	}
}
