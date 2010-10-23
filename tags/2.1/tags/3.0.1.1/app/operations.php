<?php
if (preg_match("/rspro/", $_GET['page'])) {
	if (isset($_POST['rspro-add'])) {
		rspro_add();
		rspro_redirect();
	}
	if (isset($_POST['rspro-update'])) {
		rspro_update();
		rspro_redirect();
	}
	if (isset($_GET['action']) && $_GET['action'] == "rspro-delete") {
		rspro_delete();
		rspro_redirect();
	}
	if (isset($_GET['action']) && $_GET['action'] == "rspro-restart") {
		rspro_restart();
		rspro_redirect();
	}
}
if (isset($_GET['rspro-ajax']) && is_numeric($_GET['pid'])) {
	rspro_content_generate();
}
?>