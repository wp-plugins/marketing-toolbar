<?php
require_once(RSPRO_CORE . 'library/thumb.php');
function rspro_thumber($image = NULL, $dir = NULL, $width = false, $height = false, $zc = true)
{
	$i             = new Thumber;
	$i->upload_dir = RSPRO_DIR;
	$i->upload_url = RSPRO_URL;
	$i->dir        = $dir;
	return $i->image($image, $width, $height, $zc);
}
function rspro_redirect()
{
	if (!isset($GLOBALS['popup_error'])) {
		$location = "?page=" . $_GET['page'];
		if (isset($_GET['id'])) {
			$location .= "&id=" . $_GET['id'];
		}
		if ($_GET['mode'] != "ajax") {
			echo "<script type=\"text/javascript\">setTimeout(function(){window.location='$location';},1000);</script>";
			die("<div style=\"text-align:center;width:600px;background:#FFFF99;-moz-border-radius:5px 5px 5px 5px;border:1px solid #FFCC66;padding:4px; margin:10px auto;\">Redirecting in <strong>few</strong> seconds. Please wait! or <a href=\"" . $location . "\">click here</a> if it took too long</div>");
		}
		exit();
	}
}
if(!function_exists('rspro_log')) {
function rspro_log($id = NULL, $type = "VISIT")
{
	global $wpdb;
	$data             = array();
	$data['ip']       = $_SERVER['REMOTE_ADDR'];
	$data['product_id'] = $id;
	$data['type']     = $type;
	$data['created']  = date('c');
	$wpdb->insert($wpdb->rspro_log, $data);
}}
if(!function_exists('rspro_plugin_url')) {
function rspro_plugin_url($path = '')
{
	global $wp_version;
	if (version_compare($wp_version, '2.8', '<')) {
		$folder = dirname(plugin_basename(__FILE__));
		if ('.' != $folder)
			$path = path_join(ltrim($folder, '/'), $path);
		return plugins_url($path);
	}
	return plugins_url($path, __FILE__);
}
}

if(!function_exists('rspro_chmodDir')) {
	function rspro_chmodDir($filename = '')
	{
		$stat  = @stat(dirname($filename));
		$perms = $stat['mode'] & 0007777;
		$perms = $perms & 0000666;
		if (@chmod($filename, $perms))
			return true;
		return false;
	}
}

if(!function_exists('rspro_friendlyURL')) {
	function rspro_friendlyURL($string)
	{
		$string = preg_replace("`\[.*\]`U", "", $string);
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string);
		$string = preg_replace(array(
			"`[^a-z0-9]`i",
			"`[-]+`"
		), "-", $string);
		return strtolower(trim($string, '-'));
	}
}
if(!function_exists('checkDir')){
	function checkDir($dir)
	{
	//echo $dir;
		$oldmask = umask(0);
		if (!is_dir($dir)) {
		@mkdir(str_replace('//', '/', $dir), 0777, true);
		@chmod(str_replace('//', '/', $dir), 0777);
		}
	}
}

?>