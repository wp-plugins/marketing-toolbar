<?php
global $wpdb;
wp_print_scripts(array(
	'jquery'
));
$time=time();
$exdata=$data->excludepost;
$exdata=substr($exdata,1,strlen($exdata)-2);
$exids=@explode(',',$exdata);
global $post;
$thePostID = $post->ID;
//var_dump($exids);
$table=$wpdb->prefix;


?>
<script>
var vn_count=0;
var vn_is;
var table='<?php echo $table;?>';
var tid='<?php echo $thePostID;?>';
var compressed='n';
var total_count=1;
var vn=0;
var pvt;
var strtvib;
var mover=false;
</script>
<script type="text/javascript" src="<?php echo RSPRO_BASE_URL; ?>app/js/toolbar.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo RSPRO_BASE_URL; ?>app/css/toolbar.css" media="screen" />
<script type="text/javascript">


<?php
if(is_numeric($thePostID))
if(!in_array($thePostID,$exids)){?>
jQuery(document).ready(function($){

	$('body').ssovitToolbar({url:'<?php echo $data->url; ?>'});

});

<?php } ?>
</script>

<?php
$table=$wpdb->prefix . "rs_products_toolbar";
$id=$data->id;
$hit=$data->total_hits;
$hit=$hit+1;
$a_v=$data->auto_vibration;
$v_t=$data->vibration_time;
$sql="UPDATE $table SET total_hits='$hit' WHERE id='$id'";
//mysql_query($sql);
?>
