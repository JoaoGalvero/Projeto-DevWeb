<?php
require_once "../router.php";
require_once "view.php";

$router = new Router([
	'signup_user' => 'signup_user',
	'login_user' => 'login_user'
]);
