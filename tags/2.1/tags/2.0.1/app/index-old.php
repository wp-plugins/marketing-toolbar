<?php
if (!function_exists('geoip_open')) {
	require_once( RSPRO_APP . 'library/geoip/geoip.inc');
}
function rspro_get_popup(){
	global $wpdb, $wp_query;
	$cats     = array();
	$cata     = array();
	$geoargs  = "";
	$catargs1 = "";
	$country  = rspro_ip2country();
	if (is_single()) {
		$cats = (array) get_the_category();
	} elseif (is_category()) {
		$cats[]->cat_ID = $wp_query->query_vars['cat'];
	}
	foreach ($cats as $cat) {
		$cata[] = "`categories` like '%,$cat->cat_ID,%'";
		$catargs1 .= " or `categories` like '%,$cat->cat_ID,%'";
	}
	if (!empty($cata)) {
		$catargs = 'and (' . @implode(' or ', $cata) . ')';
	} else {
		$catargs = " and (`categories` = ',,')";
	}
	$geoargs .= "`geotarget` like ',%$country->short%,'";
	$pSql   = "select $wpdb->rspro.*,media.media_path as product_image  from `$wpdb->rspro` left join `$wpdb->rspro_media` as media on (image_id=media.id) where 1=1 $catargs and ($geoargs) ";
	$sql    = "$pSql and nweight>0 and nhit>0 and status=1 order by rand()";
	$join=" left join `$wpdb->rspro` as media on (image_id=media.id)";
	$popups = $wpdb->get_results($sql);
	if (empty($popups)) {
		$pSql   = "select $wpdb->rspro.*,media.media_path as image  from `$wpdb->rspro` left join `$wpdb->rspro_media` as media on (image_id=media.id)  where 1=1 $catargs and ($geoargs or `geotarget` = ',,') ";
		$sql    = "$pSql and nweight>0 and nhit>0 and status=1 order by rand()";
		$popups = $wpdb->get_results($sql);
		if (empty($popups)) {
			$pSql   = "select $wpdb->rspro.*,media.media_path as image  from `$wpdb->rspro` left join `$wpdb->rspro_media` as media on (image_id=media.id)  where 1=1 and (categories=',,'$catargs1) and ($geoargs or `geotarget` = ',,') ";
			$sql    = "$pSql and nweight>0 and nhit>0 and status=1 order by rand() ";
			$popups = $wpdb->get_results($sql);
		}
	}
	if (!empty($popups)) {
		$popup = $popups[0];
		$nw    = $popup->nweight - 1;
		$nh    = $popup->nhit - 1;
		if($popup->hit>0){
			$sql1  = "UPDATE `$wpdb->rspro` SET `nweight` = nweight-1, `nhit` = nhit-1 WHERE `id` = '$popup->id' and status=1";
			$res1  = $wpdb->query($sql1);
		}else{
			$sql1  = "UPDATE `$wpdb->rspro` SET `nweight` = nweight-1 WHERE `id` = '$popup->id' and status=1";
			$res1  = $wpdb->query($sql1);
			
		}
		rspro_log($popup->id, 'VISIT');
		return $popup;
	} else {
		$uSql = $pSql . " and nweight=0 and nhit>0 and status=1";
		$list = $wpdb->get_results($uSql);
		if (!empty($list)) {
			foreach ($list as $l) {
				$id = $l->id;
				$w  = $l->weight;
				$wpdb->update($wpdb->rspro, array(
					'nweight' => $w
				), array(
					'id' => $id
				));
			}
			return rspro_get_popup();
		}
	}
	return NULL;
}