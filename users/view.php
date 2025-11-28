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
        header("Location: /users/template/login.php");
        exit;
    }

    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name']  = $user['name'];

    header("Location: /playlists/template/home.php");
    exit;
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

    // Redireciona pro login
    header("Location: /users/template/login.php");
    exit;
}


function logout_user($request, $pdo) {
    session_start();

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: /index.php");
    exit;
}
