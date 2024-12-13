<?php
$title = 'Internet post database';
ob_start ();
include '../templates/Home.html.php';
$output = ob_get_clean();
include '../templates/admin_layout.html.php';
