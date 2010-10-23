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
