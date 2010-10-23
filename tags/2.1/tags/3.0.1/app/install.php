<?php
global $wpdb;
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if ($wpdb->get_var("show tables like '" . $wpdb->rspro . "'") != $wpdb->rspro) {
	$sql    = "CREATE TABLE IF NOT EXISTS `" . $wpdb->rspro . "` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`title` varchar(80) NOT NULL,
								`product_link` varchar(80) NOT NULL,
								`product_text` varchar(80) NOT NULL,
								`product_color` varchar(20) NOT NULL,
				`total_hits` int(10) DEFAULT NULL,
				`vibration_time` int(10) DEFAULT NULL,
								`vibration_number` int(10) DEFAULT NULL,
								`vibration_count` int(10) DEFAULT NULL,
				`auto_vibration` varchar(50) NOT NULL,

				`display_close` varchar(80) NOT NULL,
				`price` varchar(80) NOT NULL,
				`description` text NOT NULL,
				`prod_excerpt` text NOT NULL,
				`website` varchar(250) NOT NULL,
				`color` varchar(50) NOT NULL,
				`weight` int(10) DEFAULT NULL,
				`pagetarget` varchar(200) NOT NULL DEFAULT ',,',
				`excludepost` varchar(200) NOT NULL DEFAULT ',,',
				`categories` varchar(25) NOT NULL DEFAULT ',,',
				`created` datetime DEFAULT NULL,
				`hit` int(10) DEFAULT NULL,
				`nweight` int(10) DEFAULT NULL,
				`nhit` int(10) DEFAULT NULL,
				`display` enum('1','2') DEFAULT NULL,
				`status` enum('1','2') DEFAULT '1',
				`open` enum('1','2') DEFAULT '1',
				`image_id` int(10) DEFAULT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
	$result = $wpdb->query($sql);
}
if($wpdb->get_var("show tables like '". $wpdb->rspro_media ."'") != $wpdb->rspro_media) {
	// Slide Tables
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->rspro_media . "` (
			  `id` bigint(11) NOT NULL AUTO_INCREMENT,
			  `media_path` varchar(255) NOT NULL,
			  `created` datetime NOT NULL,
			  UNIQUE KEY `id` (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			$result = $wpdb->query($sql);
}

if ($wpdb->get_var("show tables like '" . $wpdb->rspro_log . "'") != $wpdb->rspro_log) {
	$sql    = "CREATE TABLE IF NOT EXISTS `" . $wpdb->rspro_log . "` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`product_id` int(11) NOT NULL,
				`type` varchar(80) NOT NULL,
				`ip` varchar(25) NOT NULL,
				`created` datetime NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
	$result = $wpdb->query($sql);
}