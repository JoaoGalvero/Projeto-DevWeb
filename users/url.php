<?php
require_once "../_core/router.php";
require_once "view.php";

$router = new Router([
	'signup_user' => 'signup_user',
	'login_user' => 'login_user',
	'logout_user' => 'logout_user'
]);

exit;