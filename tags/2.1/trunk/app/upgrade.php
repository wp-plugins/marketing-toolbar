<?php
$rspro_settings = get_option(RSPRO_SETTING);
if ($rspro_settings['db_version'] < RSPRO_DB_VERSION) {
	$sql            = "ALTER TABLE `$wpdb->rspro` DROP `open`";
	$result         = $wpdb->query($sql);
	$sql            = "ALTER TABLE `$wpdb->rspro` ADD `aweber_html` TEXT";
	$result         = $wpdb->query($sql);
	$sql            = "ALTER TABLE `$wpdb->rspro` ADD `aweber_text` TEXT";
	$result         = $wpdb->query($sql);
	$sql            = "ALTER TABLE `$wpdb->rspro` ADD `position` ENUM('top','bottom') DEFAULT 'top'";
	$result         = $wpdb->query($sql);
	$sql			= "ALTER TABLE `$wpdb->rspro` CHANGE `geotarget` `pagetarget` VARCHAR( 25 ) NOT NULL DEFAULT ',,'";
	$result			= $wpdb->query($sql);
	$rspro_settings['db_version'] = RSPRO_DB_VERSION;
	$rspro_settings['db_version'] = 1;
	update_option(RSPRO_SETTING, $rspro_settings);
}