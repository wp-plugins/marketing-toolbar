<?php
function rspro_get_popup(){
	global $wpdb, $wp_query,$post;
	$cats     = array();
	$cata     = array();
	$pageargs  = "";
	$catargs1 = "";
	if (is_single() || is_page() || is_category()) {
		if(is_single() || is_page()){
			$pageargs .= "`pagetarget` like ',%$post->ID%,'";
			if(is_single()) $cats = (array) get_the_category();
		}elseif (is_category()) {
			$cats[]->cat_ID = $wp_query->query_vars['cat'];
			$pageargs .= "`pagetarget` = ',,'";
		}
	} else{
		$pageargs .= "`pagetarget` = ',,'";
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
		$pSql   = "select $wpdb->rspro.*,media.media_path as image  from `$wpdb->rspro` left join `$wpdb->rspro_media` as media on (image_id=media.id)  where 1=1 and (categories=',,'$catargs1) and ($pageargs or `pagetarget` = ',,')";
	$sql    = "$pSql and nweight>0 and nhit>0 and status=1 order by rand() ";
	$popups = $wpdb->get_results($sql);
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
		$uSql = $pSql . " and nweight<1 and nhit>0 and status=1";
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
?>