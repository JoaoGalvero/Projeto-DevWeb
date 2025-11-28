<?php

function create_playlist($request, $pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $cover_path = "/_static/assets/default_cover.jpg";

    if (!empty($_FILES['cover']['name'])) {
        $upload_dir = __DIR__ . "/../_static/uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $filename = uniqid() . "_" . basename($_FILES["cover"]["name"]);
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover_path = "/_static/uploads/" . $filename;
        }
    }

    $stmt = $pdo->prepare("
        INSERT INTO app.playlists (user_id, name, description, cover_image)
        VALUES (:user_id, :name, :description, :cover_image)
    ");
    $stmt->execute([
        ':user_id' => $user_id,
        ':name' => $request['name'],
        ':description' => $request['description'] ?? null,
        ':cover_image' => $cover_path,
    ]);

    // ✅ Caminho absoluto, nunca relativo
    header("Location: /playlists/template/home.php");
    exit;
}

function update_playlist($request, $pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $playlist_id = (int)$request['id'];
    $stmt = $pdo->prepare("SELECT cover_image FROM app.playlists WHERE id = :id");
    $stmt->execute([':id' => $playlist_id]);
    $current_cover = $stmt->fetchColumn();

    $cover_path = $current_cover ?: "/_static/assets/default_cover.jpg";

    if (!empty($_FILES['cover']['name'])) {
        $upload_dir = __DIR__ . "/../_static/uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $filename = uniqid() . "_" . basename($_FILES["cover"]["name"]);
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover_path = "/_static/uploads/" . $filename;
        }
    }

    $stmt = $pdo->prepare("
        UPDATE app.playlists
        SET name = :name, description = :description, cover_image = :cover_image
        WHERE id = :id
    ");
    $stmt->execute([
        ':name' => $request['name'],
        ':description' => $request['description'] ?? null,
        ':cover_image' => $cover_path,
        ':id' => $playlist_id,
    ]);

    header("Location: /playlists/template/home.php");
    exit;
}

function delete_playlist($request, $pdo) {
    $id = (int)$request['id'];
    $stmt = $pdo->prepare("DELETE FROM app.playlists WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: /playlists/template/home.php");
    exit;
}

function get_user_playlists($pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM app.playlists WHERE user_id = :uid ORDER BY created_at DESC");
    $stmt->execute([':uid' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user_name($pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT name FROM app.users WHERE id = :uid LIMIT 1");
    $stmt->execute([':uid' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? $user['name'] : 'Usuário';
}

function playlist_detail($request, $pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $id = (int)$request['id'];
    $stmt = $pdo->prepare("SELECT * FROM app.playlists WHERE id = ?");
    $stmt->execute([$id]);
    $playlist = $stmt->fetch();

    $stmt = $pdo->prepare("
        SELECT * FROM app.musics 
        WHERE playlist_id = ?
        ORDER BY added_at DESC
    ");
    $stmt->execute([$id]);
    $musics = get_playlist_embed_link($stmt->fetchAll(PDO::FETCH_ASSOC));

    include __DIR__ . "/template/playlist_detail.php";
}

function get_playlist_embed_link($rows) {
    foreach ($rows as &$row) {
        $parts = explode("track/", $row['link']);
        $row['embed_link'] = $parts[1] ?? "";
    }
    return $rows;
}

function add_music_to_playlist($request, $pdo) {
    $playlist_id = (int)$request['playlist_id'];
    $link = trim($request['link']);

    if (strpos($link, 'track/') !== false) {
        $parts = explode('track/', $link);
        $spotify_id = explode('?', $parts[1])[0];
    } else {
        $spotify_id = $link;
    }

    $stmt = $pdo->prepare("INSERT INTO app.musics (playlist_id, link) VALUES (?, ?)");
    $stmt->execute([$playlist_id, $spotify_id]);

    header("Location: /playlists/template/playlist_detail.php?id=" . $playlist_id);
    exit;
}

function delete_music($request, $pdo) {
    $id = (int)$request['id'];
    $playlist_id = (int)$request['playlist_id'];

    $stmt = $pdo->prepare("DELETE FROM app.musics WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: /playlists/template/playlist_detail.php?id=" . $playlist_id);
    exit;
}
