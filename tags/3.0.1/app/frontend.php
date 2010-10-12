<?php
function rspro_frontend()
{
	$data = rspro_get_popup();
	if (is_numeric($data->id)) {
		$data->url = get_bloginfo('home') . '/?rspro-ajax=display&pid=' . $data->id;
		require_once(RSPRO_APP . 'frontend/toolbar.php');
	}
	//echo "<pre>";print_r($data);echo "</pre>";
}
function rspro_content_generate()
{
	@ob_start();
	$id = $_GET['pid'];
	$p  = rspro_get_single($id);
	$data['title']=stripslashes($p->title);
		$data['total_hits']=stripslashes($p->total_hits);
		$data['vibration_time']=stripslashes($p->vibration_time);
		$data['vibration_number']=stripslashes($p->vibration_number);
$data['vibration_count']=stripslashes($p->vibration_count);
		$data['auto_vibration']=stripslashes($p->auto_vibration);

	$data['product_link']=stripslashes($p->product_link);
		$data['product_text']=stripslashes($p->product_text);
		$data['product_color']=stripslashes($p->product_color);

	$data['display_close']=stripslashes($p->display_close);
	$data['price']=stripslashes($p->price);
	$data['description']=stripslashes($p->description);
	$data['on_action']=stripslashes($p->prod_excerpt);
	$data['target']=stripslashes($p->website);
	$data['aweber']=stripslashes($p->aweber_html);
	$data['aweber_text']=stripslashes($p->aweber_text);
	$data['position']=stripslashes($p->position);
	$data['bg']=$p->color;
	$data['image']=NULL;
	$data['unix_datetime']=time();
	$data['date']=date('m/d/Y');
	if(strlen($p->product_image)>0){
		$data['image']=rspro_thumber($p->product_image,'product',160,125,true);
		$data['image_sm']=rspro_thumber($p->product_image,'product',40,40,true);
	}
	$product['id']=$p->id;
	$product['content']=$data;
	echo json_encode($product);
	//echo stripslashes($p->description);
	@ob_flush();
	exit();
}
function rspro_footer()
{
	echo "<a id=\"rspro_link\" style=\"display: none;\"></a>";
}