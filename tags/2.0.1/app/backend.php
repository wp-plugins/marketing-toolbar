<?php

function rspro_menu()
{
	if (function_exists('add_menu_page')) {
		add_menu_page('Toolbar Overview', 'Toolbar', 10, 'rspro_overview', 'rspro_backend_overview');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('rspro_overview', 'Toolbar Overveiw', 'Overveiw', 10, 'rspro_overview', 'rspro_backend_overview');
		add_submenu_page('rspro_overview', 'Manage Toolbars', 'Manage', 10, 'rspro_manage', 'rspro_backend_manage');
		add_submenu_page('rspro_overview', 'Add/Edit Toolbars', 'Add/Edit', 10, 'rspro_addedit', 'rspro_backend_addedit');
		
	}
}
function rspro_backend_head()
{
	if (preg_match("/rspro/", $_GET['page'])) {
		wp_register_script('rspro-tinymce', rspro_plugin_url() . '/js/tiny_mce/jquery.tinymce.js', false, '1');
		wp_print_scripts(array(
			'thickbox',
			'rspro-tinymce'
		));
		wp_print_styles('thickbox');
	require_once( RSPRO_APP."backend/header.php");
	}
}
function rspro_backend_overview()
{
	global $wpdb;
	$rspro_total   = $wpdb->get_var($wpdb->prepare("select count(*) as count from `$wpdb->rspro`;"));
	$rspro_paused  = $wpdb->get_var($wpdb->prepare("select count(*) as count from `$wpdb->rspro` where `status`=2 and nhit>0;"));
	$rspro_running = $wpdb->get_var($wpdb->prepare("select count(*) as count from `$wpdb->rspro` where `status`=1 and nhit>0;"));
	$rspro_expired = $wpdb->get_var($wpdb->prepare("select count(*) as count from `$wpdb->rspro` where `nhit`=0;"));
	require_once(RSPRO_APP . "backend/overview.php");
}
function rspro_backend_manage()
{
	require_once(RSPRO_APP . "backend/manage.php");
}
function rspro_backend_addedit()
{
	require_once(RSPRO_APP . "backend/addedit.php");
}
function rspro_backend_log()
{
	global $wpdb;
	require_once(RSPRO_APP . "backend/log.php");
}
function rspro_get_all()
{
	global $wpdb;
	$sql = $wpdb->prepare("select * from `$wpdb->rspro`");
	return $wpdb->get_results($sql);
}
function rspro_get_single($id)
{
	global $wpdb;
	$sql = $wpdb->prepare("select $wpdb->rspro.*,media.media_path as product_image  from `$wpdb->rspro` left join `$wpdb->rspro_media` as media on (image_id=media.id) where $wpdb->rspro.id='$id'");
	return $wpdb->get_row($sql);
}
function rspro_add()
{
	global $wpdb, $_POST;
	$postids=explode(',',str_replace(",,",",",$_POST['pagetarget']));
	$posts=@implode(',', $postids);
		$exids=explode(',',str_replace(",,",",",$_POST['excludepost']));
	$excludes=@implode(',', $exids);
	$data = array(
		'title' => stripslashes($_POST['title']),
				'display_close' => stripslashes($_POST['display_close']),
				'product_link' => stripslashes($_POST['product_link']),
				'product_text' => stripslashes($_POST['product_text']),
				'product_color' => stripslashes($_POST['product_color']),
'vibration_time' => stripslashes($_POST['vibration_time']),
'vibration_number' => stripslashes($_POST['vibration_number']),
'vibration_count' => stripslashes($_POST['vibration_count']),

'auto_vibration' => stripslashes($_POST['auto_vibration']),

		'price' => stripslashes($_POST['price']),
		'description' => stripslashes($_POST['description']),
		'prod_excerpt' => stripslashes($_POST['prod_excerpt']),
		'website' => stripslashes($_POST['website']),
		'color' => stripslashes($_POST['color']),
		'weight' => (int) $_POST['rspro_weight'],
		'hit' => (int) $_POST['rspro_hit'],
		'status' => (int) $_POST['status'],
		'nweight' => (int) $_POST['rspro_weight'],
		'nhit' => (int) $_POST['rspro_hit'],
		'aweber_html' => stripslashes($_POST['aweber_html']),
		'aweber_text' => stripslashes($_POST['aweber_text']),
		'position' => stripslashes($_POST['position']),
		'pagetarget' => ','.str_replace(",,","",$posts).',',
		'excludepost' => ','.str_replace(",,","",$excludes).',',
		'categories' => ',' . @implode(',', $_POST['rspro_categories']) . ',',
		'created' => date('c')
	);
	if ($data['hit'] < 1){
		$data['hit'] = 0;
		$data['nhit'] = 1;
	}
	if ($data['weight'] < 1){
		$data['weight'] = 1;
		$data['nweight'] = 1;
	}
	if (strlen($data['color']) < 1){
		$data['color']='#5c5c66';
	}
	$data['image_id'] = rspro_upload_image();
	extract($data);
	$wpdb->insert($wpdb->rspro, $data);
	$id = $_GET['id'] = $wpdb->insert_id;
	rspro_log($id, 'ADD');
}
function rspro_upload_image(){
	global $wpdb;
	$file = $_FILES['product_image']['name'];
	$ext = strtolower(substr($file, strrpos($file, '.') + 1, strlen($file)));
	$name = rspro_friendlyURL(substr($file, 0, strrpos($file, '.')));
	$srcFile = $_FILES['product_image']['tmp_name'];
	$size = $_FILES['product_image']['size'][$i];
	if (file_exists(RSPRO_DIR . '/' . $name . '.' . $ext)) {
		$name = $name . '-' . time();
	}
	$filename = $name . '.' . $ext;
	$targetFile = RSPRO_DIR . '/' . $filename;
	if (@move_uploaded_file($srcFile, $targetFile)) {
		$sql = $wpdb->prepare("insert into `$wpdb->rspro_media` (`media_path`,`created`) 
		values( '$filename','" . date('c') . "')");
		$result     = $wpdb->query($sql);
		$image_id = $wpdb->insert_id;
		rspro_chmodDir($targetFile);
		return $image_id;
	}
	return 0;
}
function rspro_update()
{
	global $wpdb, $_POST;
	$postids=explode(',',str_replace(",,",",",$_POST['pagetarget']));
	$posts=@implode(',', $postids);
		$exids=explode(',',str_replace(",,",",",$_POST['excludepost']));
	$excludes=@implode(',', $exids);
	$data = array(
		'title' => stripslashes($_POST['title']),
						'display_close' => stripslashes($_POST['display_close']),
						'product_link' => stripslashes($_POST['product_link']),
						'product_text' => stripslashes($_POST['product_text']),
						'product_color' => stripslashes($_POST['product_color']),
						'vibration_number' => stripslashes($_POST['vibration_number']),

						'vibration_time' => stripslashes($_POST['vibration_time']),
						'auto_vibration' => stripslashes($_POST['auto_vibration']),
'vibration_count' => stripslashes($_POST['vibration_count']),

		'price' => stripslashes($_POST['price']),
		'description' => stripslashes($_POST['description']),
		'prod_excerpt' => stripslashes($_POST['prod_excerpt']),
		'website' => stripslashes($_POST['website']),
		'color' => stripslashes($_POST['color']),
		'weight' => (int) $_POST['rspro_weight'],
		'hit' => (int) $_POST['rspro_hit'],
		'aweber_html' => stripslashes($_POST['aweber_html']),
		'aweber_text' => stripslashes($_POST['aweber_text']),
		'position' => stripslashes($_POST['position']),
		'status' => (int) $_POST['status'],
		'pagetarget' => ','.str_replace(",,","",$posts).',',
				'excludepost' => ','.str_replace(",,","",$excludes).',',

		'categories' => ',' . @implode(',', $_POST['rspro_categories']) . ','
	);
	if ($data['hit'] < 1){
		$data['hit'] = 0;
		$data['nhit'] = 1;
	}
	if ($data['weight'] < 1){
		$data['weight'] = 1;
		$data['nweight'] = 1;
	}
	if (strlen($data['color']) < 1){
		$data['color']='#5c5c66';
	}
	$mediaid=rspro_upload_image();
	if($mediaid>0){
		$data['image_id'] = $mediaid;
	}
			
	extract($data);
	$result = $wpdb->update($wpdb->rspro, $data, array(
		'id' => $_POST['popup_id']
	));
	$id     = $_GET['id'] = $_POST['popup_id'];
	rspro_log($id, 'UPDATE');
}
function rspro_delete($ipopupid = NULL)
{
	global $wpdb;
	if (!isset($rsproid)) {
		$rsproid = $_GET['rspro-id'];
	}
	$sql    = "delete from `$wpdb->rspro` where `id`=$rsproid";
	$result = $wpdb->query($sql);
	if (!isset($result)) {
		$GLOBALS['popup_error'] = true;
	}
}
function rspro_restart()
{
	global $wpdb;
	$rsproid = $_GET['pid'];
	$sql      = "update `$wpdb->rspro` as rspro set rspro.nhit=rspro.hit where `id`=$rsproid";
	$result   = $wpdb->query($sql);
	rspro_log($rsproid, 'RESTART');
	if (!isset($result)) {
		$GLOBALS['popup_error'] = true;
	}
}
function rspro_get_logs($type = "VISIT")
{
	global $wpdb;
	$sql    = "select * from `$wpdb->rspro_log` where `type`='$type' order by `created` desc limit 100";
	$result = $wpdb->get_results($sql);
	return $result;
}
