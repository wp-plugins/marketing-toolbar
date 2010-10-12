<?php
require_once('../../../wp-config.php');
$product_id=$_GET['id'];
$table=$_GET['name'].'rs_products_log';
$type='CLICK';
$ip=$_SERVER['REMOTE_ADDR'];
$created=date("Y-m-d H:i:s");
$sql="INSERT INTO $table (product_id,type,ip,created) VALUES ('$product_id','$type','$ip','$created')";
mysql_query($sql);
// this is updated verions
?>