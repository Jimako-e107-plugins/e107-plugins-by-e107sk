<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Disqus Plugin
 *
 * #######################################
 * #     e107 website system plugin      #
 * #     by Jimako                    	 #
 * #     https://www.e107sk.com          #
 * #######################################
 */

if (!defined('e107_INIT'))
{
	exit;
}

class disqus_shortcodes extends e_shortcode
{
	public $override = false; // when set to true, existing core/plugin shortcodes matching methods below will be overridden.

	/**
	WAY HOW TO DISPLAY DISQUS COMMENT SYSTEM WITH NATIVE Comments
	{DISQUS_COMMENTS}
	 **/
	public function sc_disqus_comments($parm)
	{
		$path = $parm;
		$file = e_PLUGIN . 'disqus/e_comment.php';
		e107_require_once($file);

		$class = new disqus_comment();

		$text = $class->disqus(array());

		return $text;
	}

	/**
	WAY HOW TO DISPLAY DISQUS COMMENT SYSTEM WITH NATIVE Comments
	{DISQUS_NEWSCOMMENTCOUNT}
	 **/
	public function sc_disqus_newscommentcount($parm)
	{

		$plugPref = e107::pref('disqus');

		$forum_shortname = vartrue($plugPref['forum_shortname'], '');

		$path = $parm;
		$sc = e107::getScBatch('news');
		$data = $sc->getScVar('news_item');

		/*
			        <a href="http://example.com/article1.html#disqus_thread" data-disqus-identifier="article_1_identifier">First article</a>
		*/
		$anchor = '#disqus_thread';
		if ($plugPref['use_lazyloading'])
		{
			$anchor = '#disqus_com';
		}

		$entity_name = "news";
		$entity_id = $data['news_id'];
		$datadisqusidentifier = $entity_name . "." . $entity_id;

		$url = e107::getUrl()->create('news/view/item', $data);

		$text = '<a href="' . $url . $anchor . '" data-disqus-identifier="' . $datadisqusidentifier . '">xx</a>';
		return $text;

	}

}