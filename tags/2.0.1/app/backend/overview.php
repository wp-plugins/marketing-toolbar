<?php
global $wpdb;
?>

<div class="wrap">
  <div id="icon-users" class="icon32"><br>
  </div>
  <h2>Overview</h2>
  <table cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th colspan="2" scope="col">Products Toolbars</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>
          <?php _e('Total'); ?>
          &nbsp;</strong></td>
        <td><a href="?page=rspro_manage"><?php echo $rspro_total; ?>&nbsp;</a></td>
      </tr>
      <tr>
        <td><strong>
          <?php _e('Running Toolbars'); ?>
          &nbsp;</strong></td>
        <td><?php echo $rspro_running; ?>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>
          <?php _e('Paused Toolbars'); ?>
          &nbsp;</strong></td>
        <td><?php echo $rspro_paused; ?>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>
          <?php _e('Expired Toolbars'); ?>
          &nbsp;</strong></td>
        <td><?php echo $rspro_expired; ?>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</div>
<div>
<?php
if($_POST['update']=='yes')
{
@mysql_query("ALTER TABLE `".$wpdb->rspro."` ADD `product_link` varchar(80) NOT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `product_text` varchar(80) NOT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `product_color` varchar(20) NOT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `total_hits` int(10) DEFAULT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `vibration_time` int(10) DEFAULT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `vibration_number` int(10) DEFAULT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `vibration_count` int(10) DEFAULT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `auto_vibration` varchar(50) NOT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `display_close` varchar(80) NOT NULL");
@mysql_query("ALTER TABLE `".$wpdb->rspro."`ADD `price` varchar(80) NOT NULL");	
}
?>
<?php
$raw=array();
$result = mysql_query("SHOW FIELDS FROM $wpdb->rspro");
$i = 0;
while ($row = mysql_fetch_array($result)) {
$raw[]=$row['Field'];
}
if(!in_array('vibration_count',$raw))
echo "<br><br><br><br>
Dear User,<br>
<b>Your are using <font color='red'>old version database</font> of Wordpress marketing toolbar Plugin. New Version May not work properly with old databse so Please Update your database by clicking in \"Update My Database\" Button Below.\n
Thanks!</b><br><br>".'
<form name="check" method="post">
<input type="hidden" name="update" value="yes" />
<input type="submit" value="Update My Database"  />
</form>
';

?>


</div>