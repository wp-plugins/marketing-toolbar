<div class="wrap">
  <div id="icon-users" class="icon32"><br>
  </div>
  <h2>Log Statistics</h2>
  <div style=" float:right">
    <div class="subsubsub">
      <ul>
        <li><a href="?page=<?php echo $_GET['page']; ?>&type=VISIT">Visitor Log</a> | </li>
        <li><a href="?page=<?php echo $_GET['page']; ?>&type=ADD">Addition Log</a> | </li>
        <li><a href="?page=<?php echo $_GET['page']; ?>&type=UPDATE">Update Log</a> | </li>
        <li><a href="?page=<?php echo $_GET['page']; ?>&type=RESTART">Campaign Restart Log</a></li>
      </ul>
    </div>
  </div>
  <div style="clear:both"></div>
  <table class="widefat" cellspacing="0" id="ssovit_albums">
    <thead>
      <tr>
        <th scope="col">IP</th>
        <th scope="col">Date</th>
        <th scope="col">Event</th>
        <th scope="col">Popup ID</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th scope="col">IP</th>
        <th scope="col">Date</th>
        <th scope="col">Event</th>
        <th scope="col">Popup ID</th>
      </tr>
    </tfoot>
    <?php
		if(!isset($_GET['type'])){
			$_GET['type']='VISIT';
		}
$list=rspro_get_logs($_GET['type']);
foreach($list as $log):
?>
    <tr id="log-<?php echo $log->id; ?>" class="albums-row">
      <td scope="col"><?php echo $log->ip; ?></td>
      <td scope="col"><?php echo date('m-d-Y \a\t h:m a',strtotime($log->created)); ?></td>
      <td scope="col"><?php echo ucfirst($log->type); ?></td>
      <td scope="col"><?php echo $log->popup_id; ?></td>
    </tr>
    <?php
endforeach;
?>
  </table>
</div>
