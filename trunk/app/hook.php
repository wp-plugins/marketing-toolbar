<?php
add_action('admin_menu', 'rspro_menu');
add_action('admin_head', 'rspro_backend_head');
add_action('wp_head','rspro_frontend');
add_action('wp_footer','rspro_footer');
?>