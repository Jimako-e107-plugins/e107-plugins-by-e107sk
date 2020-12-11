<?php

// Generated e107 Plugin Admin Area

require_once '../../../class2.php';
if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

e107::lan('gsitemap', true);
e107::lan('jmgsitemap', true);

class gsitemap_adminArea extends e_admin_dispatcher
{

	protected $modes = array(

		'sitemap' => array(
			'controller' => 'gsitemap_ui',
			'path' => null,
			'ui' => 'gsitemap_form_ui',
			'uipath' => null,
		),
	);

	protected $adminMenu = array(

		'sitemap/list' => array('caption' => LAN_JM_GSITEMAP_LAN_04, 'perm' => 'P'),
		'sitemap/create' => array('caption' => GSLAN_22, 'perm' => '7'),
		'sitemap/instructions' => array('caption' => GSLAN_21, 'perm' => '7'),
		'sitemap/prefs' => array('caption' => LAN_JM_GSITEMAP_LAN_05, 'perm' => 'P'),
		'sitemap/help' => array('caption' => LAN_HELP, 'perm' => '0'),
	);

	protected $adminMenuAliases = array(
		'sitemap/edit' => 'sitemap/list',
	);

	protected $menuTitle = LAN_JM_GSITEMAP_LAN_06;
}

class gsitemap_ui extends e_admin_ui
{

	protected $pluginTitle = LAN_JM_GSITEMAP_LAN_06;
	protected $pluginName = 'jmgsitemap';
	//	protected $eventName		= 'gsitemap-gsitemap'; // remove comment to enable event triggers in admin.
	protected $table = 'gsitemap';
	protected $pid = 'gsitemap_id';
	protected $perPage = 200;
	protected $batchDelete = true;
	protected $batchExport = true;
	protected $batchCopy = true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable.

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder = 'gsitemap_order asc';
	protected $sortField = 'gsitemap_order';
	protected $orderStep = 1;

	protected $fields = array('checkboxes' => array('title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect'),
		'gsitemap_id' => array('title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left', 'forced' => '1',),
		'gsitemap_name' => array('title' => LAN_NAME, 'type' => 'text', 'data' => 'str', 'width' => 'auto',
			'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size' => 'block-level'), 'class' => 'left', 'thclass' => 'left'),
		'gsitemap_url' => array('title' => LAN_URL, 'type' => 'url', 'data' => 'str', 'width' => 'auto',
			'inline' => true, 'help' => '', 'readParms' => '',
			'writeParms' => array('size' => 'block-level'), 'class' => 'left', 'thclass' => 'left'),
		'gsitemap_lastmod' => array('title' => GSLAN_27, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'),
		'gsitemap_freq' => array('title' => GSLAN_10, 'type' => 'dropdown',
			'data' => 'str', 'width' => 'auto', 'batch' => true,
			'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'),

		'gsitemap_priority' => array('title' => GSLAN_9, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'),

		'gsitemap_cat' => array('title' => LAN_CATEGORY, 'type' => 'dropdown',
			'data' => 'str', 'width' => 'auto', 'batch' => true,
			'filter' => true, 'inline' => false, 'help' => '',
			'readParms' => '', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),

		'gsitemap_table' => array('title' => "DB Table", 'type' => 'dropdown',
			'data' => 'str', 'width' => 'auto', 'batch' => true,
			'filter' => true, 'inline' => false, 'help' => '',
			'readParms' => '', 'writeParms' => array(), 'class' => 'left', 'thclass' => 'left'),
		
		'gsitemap_table_id' => array('title' => "DB Table ID", 'type' => 'number', 'data' => null),

			'gsitemap_order' => array('title' => LAN_ORDER, 'type' => 'number', 'data' => null),
		//	  'gsitemap_img' =>   array ( 'title' => 'Img', 'type' => 'image', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => 'thumb=80x80', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
 		'gsitemap_active' => array('title' => LAN_ACTIVE, 'type' => 'userclass', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'inline' => true,
			'filter' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left'),



		'options' => array('title' => LAN_OPTIONS, 'type' => null, 'forced' => TRUE, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center', 'readParms' => 'sort=1'),
	);

	protected $fieldpref = array('gsitemap_id', 'gsitemap_name', 'gsitemap_url', 'gsitemap_lastmod', 'gsitemap_freq', 'gsitemap_cat', 'gsitemap_order', 'gsitemap_active', 'gsitemap_visibility', 'gsitemap_item_id', 'gsitemap_type');
 

	var $cat_list;
	var $table_list;

	public function init()
	{

		$this->freq_list = array
			(
			"always" => GSLAN_11,
			"hourly" => GSLAN_12,
			"daily" => GSLAN_13,
			"weekly" => GSLAN_14,
			"monthly" => GSLAN_15,
			"yearly" => GSLAN_16,
			"never" => LAN_NEVER,
		);

		//$addons = e107::getAddonConfig('e_gsitemap', null, 'config');  //needs to be added to work
		
		$addons = e107::getAddonConfig('e_gsitemap', null, 'import');  //needs to be added to work
	 
		// core todo move to e_gsitemap 

		$categories[''] = '';
		$categories['Page'] = 'Page';    /* custom pages ... */
		$categories[GSLAN_1] = GSLAN_1;  /* sitelinks ... */
		
		$tables[''] = '';
		$tables['cpage'] = 'cpage';     /* custom pages ... */
		$tables['links'] = 'links';  	/* sitelinks ... */

		foreach($addons AS $addon) {
			foreach($addon AS $item) {   
				$type = $item['type'];   
				$table = $item['table'];   
				$categories[$type] = $type;
				$tables[$table] = $table;
			}
		}
		 
		$this->cat_list = $categories;
		$this->table_list = $tables;
 

		for ($i = 0.1; $i < 1.0; $i = $i + 0.1)
		{
			$value = number_format($i, 1);
			$this->priority_list[$value] = $value;
		};

		// Set drop-down values (if any).
		$this->fields['gsitemap_freq']['writeParms'] = $this->freq_list;
		$this->fields['gsitemap_priority']['writeParms'] = $this->priority_list;
		$this->fields['gsitemap_cat']['writeParms'] = $this->cat_list;
		$this->fields['gsitemap_table']['writeParms'] = $this->table_list;
	}

	// ------- Customize Create --------

	public function beforeCreate($new_data, $old_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onCreateError($new_data, $old_data)
	{
		// do something
	}

	// ------- Customize Update --------

	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
		// do something
	}

	// optional - a custom page.
	public function instructionsPage()
	{
		$this->instructions();
	}

	public function instructions()
	{
		$mes = e107::getMessage();
		$ns = e107::getRender();

		$content = '<div class="panel panel-primary">
						<h4 class="panel-heading ">Link for Google Search Console:</h4>
						<div class="panel-body">
            <code>' . SITEURL . 'gsitemap.php' . '</code>  or <a target="_blank" href="' . SITEURL . 'gsitemap.php">click</a>
            </div>
            </div>
            ';

		$content .= '<div class="panel panel-primary">
						<h4 class="panel-heading">Link for HTML sitemap:</h4>
						<div class="panel-body">
            <code>' . SITEURL . 'gsitemap.php?show=1</code>  or <a target="_blank" href="' . SITEURL . 'gsitemap.php?show=1">click</a>
            </div>
            </div>
            ';

		$content .= '<div class="panel panel-primary">
						<h4 class="panel-heading">Pretty Link for HTML sitemap:</h4>
						<div class="panel-body">
            <code>' . SITEURL . 'sitemap/</code>  or <a target="_blank" href="' . SITEURL . 'sitemap/">click</a>
            </div>
            </div>
            ';

		$content .= '<div class="panel panel-warning">
						<h4 class="panel-heading">Avoid double content for HTML sitemap</h4>
						<div class="panel-body">
             Add the same canonical URL for 3 versions of HTML sitemap:    <br />
              <code>' . SITEURL . 'sitemap/</code> <br />
			  <code>' . SITEURL . 'sitemap</code>   <br />
			  <code>' . SITEURL . 'gsitemap.php?show</code>   <br />
              <code>' . SITEURL . 'gsitemap.php?show=1</code>
            </div>
            </div>
            ';

		$ns->tablerender('', $mes->render() . $content);
	}

	public function helpPage()
	{
		$ns = e107::getRender();

		include 'e_help.php';
		$text = '<div class="tab-content"><div class="tab-pane  active">' . $helplink_text['body'] . '</div></div>';
		$ns->tablerender('', $text);

	}

}

class gsitemap_form_ui extends e_admin_form_ui
{
 

}

new gsitemap_adminArea();

require_once e_ADMIN . "auth.php";
e107::getAdminUI()->runPage();

require_once e_ADMIN . "footer.php";
exit;
 