<?php
require_once "../_core/router.php";
require_once "view.php";

$router = new Router([
	'create_playlist' => 'create_playlist',
	'update_playlist' => 'update_playlist',
	'delete_playlist' => 'delete_playlist',
	'playlist_details' => 'playlist_detail',
	'add_music_to_playlist' => 'add_music_to_playlist',
	'delete_music' => 'delete_music',
	'get_explore_page' => 'get_explore_page',
	'explore_playlist_detail' => 'explore_playlist_detail',
]);
