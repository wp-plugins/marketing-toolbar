<?php
$categories_obj    = get_categories('hide_empty=0');
$rspro_categories = array();
foreach ($categories_obj as $rspro_cat) {
	$rspro_categories[$rspro_cat->cat_ID] = $rspro_cat->cat_name;
}