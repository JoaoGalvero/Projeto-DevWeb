<?php

function login_user($request, $pdo) {
	session_start();
	$stmt = $pdo->prepare("
        SELECT id, email, password_hash, name
        FROM app.users
        WHERE email = :email
        LIMIT 1
    ");

    $stmt->execute([':email' => $request['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($request['password'], $user['password_hash'])) {
		$_SESSION['error'] = "Email ou senha inválidos.";
		return header("Location: template/login.html");
	}

    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name']  = $user['name'];
	return header("Location: ../playlists/template/list_playlist.php");
}

function signup_user($request, $pdo) {
    $hash = password_hash($request['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO app.users (email, password_hash, name)
        VALUES (:email, :password_hash, :name)
    ");

    $stmt->execute([
        ':email' => $request['email'],
        ':password_hash' => $hash,
        ':name' => $request['username']
    ]);
}
