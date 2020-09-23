<?php
/**
 * e107 website system
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

e107::lan('disqus', true);

// all: you can't use e_module because e_PAGE and e_QUERY are not defined there
// all: you can't use e_header because e_comment is loaded sooner see $_addon_types
// all: you can't use e_meta because addons are sorted alphabetically see getAddonsList
// single page: you can't use $_GET because page has wrong keys
// single page: e_PAGETITLE is not defined in e_comment with pages, but it is with news
// single page: don't use x.0 because if they fix pagination in future, you need one discuss for one ID
// single page: $this->pageSelected - there is bug for new urls way, use legacy way with dot
// content: e_URL_LEGACY is not defined anymore, no idea why, DIY
// content: not able to use legacy e_comment.php
// content: not able to use new e_comment.php in jmcontent plugin because the same addon is loaded by plugin names (jmc is after d)

class disqus_comment
{
	private $forum_shortname;
	private $entity;
	private $entity_url;
	private $entity_name;
	private $entity_id;
	private $entity_title;

	public function __construct()
	{
		$plugPrefs = e107::pref('disqus');

		$this->forum_shortname = vartrue($plugPrefs['forum_shortname'], '');
		$this->plugPrefs = $plugPrefs;

		if (empty($this->forum_shortname))
		{
			return "<div class='alert alert-important alert-danger'>Missing Forum shortname!</div>";
		}

		if (true)
		{
			$page = defset('e_PAGE', '');
			$query = defset('e_QUERY', '');

			$this->entity = '';

			// view single news
			
			if ($page == 'news.php' && substr($query, 0, 7) == 'extend.')
			{
				$this->entity = 'news';
				$this->entity_url = $page . "?" . $query;
				$this->entity_name = "news";
				$this->entity_id = (int)str_replace('extend.', '', $query);
				$this->entity_title = e_PAGETITLE;
			}
			elseif ($page == 'page.php')
			{
				$single_page = e107::getRegistry('core/page/request');
				if (!empty($single_page['id']) && $single_page['action'] == 'showPage')
				{
					$this->entity = 'page';
					$this->entity_url = $page . "?" . $single_page['id'];
					$this->entity_name = "page";
					$this->entity_id = (int)$single_page['id'];
					$this->entity_title = 'Single Custom Page';
				}
			}
			elseif ($page == 'content.php')
			{
				$tmp = explode(".", $query);

				//special comment page is cat.99.comments
				if ($tmp[0] == 'cat')
				{
					$this->entity = 'content_cat';
					$this->entity_url = e_PLUGIN."content/".$page . "?" . $tmp[0] .".". $tmp[1];
					$this->entity_name = "content." . $tmp[0];
					$this->entity_id = (int)$tmp[1];
					$this->entity_title = e_PAGETITLE;
				}

			}

		}

	}

	public function config() // Admin Area Configuration.
	{
		$config = array();
		$config[] = array('name' => "Disqus", 'function' => 'disqus');
		return $config;
	}

	public function disqus($data)
	{
		if (empty($this->entity_url))
		{
			if (ADMIN)
			{
				return "<div class='alert alert-important alert-danger'>this.page.url is not defined. It is could be correct, if you don't want to display disqus here.</div>";
			}
			return '';
		}

		if (empty($this->entity_name))
		{
			if (ADMIN)
			{
				return "<div class='alert alert-important alert-danger'>this.page.identifier is not defined. It is could be correct, if you don't want to display disqus here.</div>";
			}
			return '';
		}

		if ($this->entity == 'news' && $this->plugPrefs['hide_entity_news'])
		{
			if (ADMIN)
			{
				return "<div class='alert alert-important alert-danger'>Disqus is disabled for news items. </div>";
			}
			return '';
		}

		if ($this->entity == 'page' && $this->plugPrefs['hide_entity_page'])
		{
			if (ADMIN)
			{
				return "<div class='alert alert-important alert-danger'>Disqus is disabled for page items. </div>";
			}
			return '';
		}

		if ($this->entity == 'content_cat' && $this->plugPrefs['hide_entity_content-cat'])
		{
			if (ADMIN)
			{
				return "<div class='alert alert-important alert-danger'>Disqus is disabled for content cat items. </div>";
			}
			return '';
		}
		if ($this->plugPrefs['use_lazyloading'])
		{

			$throttle = varset($this->plugPrefs['throttle'], 250);
			$laziness = varset($this->plugPrefs['laziness'], 250);

			$text = '
			<div id="disqus_com"></div>
			<div class="disqus"  ></div>';
			$text .= '<script>';
			$text .= "var options =
					{
					scriptUrl: '//" . $this->forum_shortname . ".disqus.com/embed.js',
					laziness: " . $laziness . ",
					throttle: " . $throttle . ",
					disqusConfig: function()
					{
						this.page.title       = '" . $this->entity_title . "';
						this.page.url         = '" . SITEURL . $this->entity_url . "';
						this.page.identifier  = '" . $this->entity_name . "." . $this->entity_id . "';
					}
					};
					";

			$text .= "$.disqusLoader( '.disqus', options );";
			$text .= '</script>';

		}
		else
		{
			//normal disqus way
			$text = $test . '

			 <div id="disqus_thread"></div>
              <script>
              var disqus_config = function () {
              this.page.url = "' . SITEURL . $this->entity_url . '";
              this.page.identifier =  "' . $this->entity_name . "." . $this->entity_id . '";
              this.page.title = "' . $this->entity_title . '";
              };

              (function() { // DON T EDIT BELOW THIS LINE
              var d = document, s = d.createElement("script");
              s.src = "https://' . $this->forum_shortname . '.disqus.com/embed.js";
              s.setAttribute("data-timestamp", +new Date());
              (d.head || d.body).appendChild(s);
              })();
              </script>
              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			  ';
		}
		return $text;
	}
}
