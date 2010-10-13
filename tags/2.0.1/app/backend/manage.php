<?php
//ini_set('error_reporting',0);

$today = date("Y-m-d");

$yesterday = date("Y-m-d",strtotime(date("Y-m-d", strtotime($today)) . " -1 day"));
$thisweek = date("Y-m-d",strtotime(date("Y-m-d", strtotime($today)) . " -7 day"));
$thismonth = date("Y-m-d",strtotime(date("Y-m-d", strtotime($today)) . " -1 month"));

function clickcount($date,$id,$type='VISIT')
{
global $wpdb;
$table=$wpdb->prefix . "rs_products_log";
$sql="select count(*) as counts from `$table` WHERE product_id='$id' AND type='$type' AND created>='$date'";
$rspro_total   = $wpdb->get_var($wpdb->prepare($sql));

return $rspro_total;
}
$pro_toolbars = rspro_get_all();


?>

<div class="wrap">
  <div id="icon-users" class="icon32"><br>
  </div>
  <h2>Manage Toolbars</h2>
  <table cellspacing="0" class="widefat">
    <?php if(count($pro_toolbars)>0){ ?>
    <thead>
      <tr>
        <th width="193" scope="col">Title</th>
        <th width="48" scope="col">Weight</th>
		        <th width="250" scope="col" ><center>Clicks</center></th>

                <th width="250" scope="col" align="center"><center>Views</center></th>
                <th width="59" scope="col">Status</th>
        <th width="94" scope="col">Created</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pro_toolbars as $rspro){?>
      <tr>
        <td><a href="?page=rspro_addedit&id=<?php echo $rspro->id; ?>"><strong><?php echo $rspro->title; ?></strong></a>
          <div class="row-actions"><span class="edit"><a href="?page=rspro_addedit&id=<?php echo $rspro->id; ?>" class="album_edit_link">Edit</a></span> | <span class="edit"><a href="?page=rspro_manage&action=rspro-restart&pid=<?php echo $rspro->id; ?>" class="album_edit_link">Restart Campaign</a></span> | <span class="trash ssovit-delete-album"><a href="?page=rspro_manage&action=rspro-delete&rspro-id=<?php echo $rspro->id; ?>" onclick="if(confirm('Do you want to delete this toolbar?')){return true;}else{return false;}" class="album_thrash_link">Delete</a></span></div></td>
        <td><?php echo $rspro->weight; ?></td>
<td><?php /*if($rspro->hit>1){; ?><?php echo $rspro->hit-$rspro->nhit; ?> (<?php echo @round(($rspro->hit-$rspro->nhit)*100/$rspro->hit,2); ?> %)<?php }else{ ?>(Unlimited)<?php }*/  //echo $rspro->total_hits;?>

<center><table align="center" style="border:1px solid #c5c5c5" cellpadding="5" cellspacing="5"><tr><td><strong>Today</strong>:<?php echo clickcount($today,$rspro->id,'CLICK');?></td><td> <strong>Yesterday</strong>:<?php echo (clickcount($yesterday,$rspro->id,'CLICK')-clickcount($today,$rspro->id,'CLICK'));?></td><tr><td><strong>This Weeek</strong>:<?php echo clickcount($thisweek,$rspro->id,'CLICK');?></td><td> <strong>This Month</strong>:<?php echo clickcount($thismonth,$rspro->id,'CLICK');?></td></tr><tr><td colspan="2"> <strong>Total</strong>:<?php echo clickcount("2010-01-01",$rspro->id,'CLICK');?></td></tr></tr></table></center>


</td>		
        <td width="200">
	<center><table align="center" style="border:1px solid #c5c5c5;width:260px;" cellpadding="5" cellspacing="5"><tr><td><strong>Today</strong>:<?php echo clickcount($today,$rspro->id);?></td><td> <strong>Yesterday</strong>:<?php echo (clickcount($yesterday,$rspro->id)-clickcount($today,$rspro->id));?></td><tr><td><strong>This Weeek</strong>:<?php echo clickcount($thisweek,$rspro->id);?></td><td> <strong>This Month</strong>:<?php echo clickcount($thismonth,$rspro->id);?></td></tr><tr><td colspan="2"> <strong>Total</strong>:<?php echo clickcount("2010-01-01",$rspro->id);?></td></tr></tr></table></center>
	
	
	
	
	</td>
        
        <td><?php if($rspro->status==1 && $rspro->nhit>0){echo "<span style=\"color:green\">Running</span>";} ?>
          <?php if($rspro->status==2 && $rspro->nhit>0){echo "<span style=\"color:blue\">Paused</span>";} ?>
          <?php if($rspro->nhit<1){echo "<span style=\"color:red\">Stopped</span>";} ?></td>
        <td><?php echo date("F j, Y",strtotime($rspro->created));?></td>
      </tr>
      <?php } ?>
    </tbody>
    <?php } else {?>
    <thead>
      <tr>
        <th scope="col">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td> No toolbars Listed.. <a href="?page=rspro_addedit">Add New</a></td>
      </tr>
      <?php } ?>
  </table>
</div>

