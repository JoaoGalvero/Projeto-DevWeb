<?php
require_once "../_core/router.php";
require_once "view.php";

$router = new Router([
	'create_playlist' => 'create_playlist',
	'update_playlist' => 'update_playlist',
	'delete_playlist' => 'delete_playlist',
]);
