<?php
/*
Plugin Name: Marketing Toolbar
Plugin URI: http://krishnabhattarai.com/plugin/marketing-toolbar/
Description: Marketing Toolbar plugin developed by <a href="http://krishnabhattarai.com/">Krishna Bhattarai</a>
Author: Krishna Bhattarai
Author URI: http://krishnabhattarai.com
Version: 2.0.1
*/
?>
<?php
global $wpdb; 
$wpdb->custompluginpath = realpath(dirname(__FILE__)) . '/';
if (version_compare($wp_version, '2.8', '<')) {
	$folder = dirname(plugin_basename(__FILE__));
	if ('.' != $folder)
		$path = path_join(ltrim($folder, '/'), $path);
	$wpdb->custompluginurl = plugins_url($path) . '/';
} else {
	$wpdb->custompluginurl = plugins_url($path, __FILE__) . '/';
}
if(!defined('SSOVIT_DEBUG')){@define('SSOVIT_DEBUG', false);}
require_once('core/functions.php');
require_once('app/constants.php');
require_once('app/vars.php');
require_once('app/index.php');
require_once('app/hook.php');
require_once('app/function.php');
require_once('app/install.php');
require_once('app/upgrade.php');
require_once('app/backend.php');
require_once('app/frontend.php');
require_once('app/widget.php');
require_once('app/operations.php');
