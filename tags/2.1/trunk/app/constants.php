<?php
global $wpdb;
$wpdb->rspro       = $wpdb->prefix . "rs_products_toolbar";
$wpdb->rspro_media = $wpdb->prefix . "rs_products_media";
$wpdb->rspro_log   = $wpdb->prefix . "rs_products_log";
$up = wp_upload_dir();
@define('RSPRO_BASE', $wpdb->custompluginpath);
@define('RSPRO_BASE_URL', $wpdb->custompluginurl);
@define('RSPRO_CORE', RSPRO_BASE."core/");
@define('RSPRO_APP', RSPRO_BASE."app/");
@define('RSPRO_DIR', $up['basedir']);
@define('RSPRO_URL', $up['baseurl']);
@define('RSPRO_DB_VERSION', 2);
@define('RSPRO_SETTING', "rspro_settings");
?>