<?php

function create_playlist($request, $pdo) {
	session_start();

	if (!isset($_SESSION['user_id'])) {
        return header("Location: ../users/template/login.html");
    }

	$user_id = $_SESSION['user_id']; 

	$cover_path = null;
    if (!empty($_FILES['cover']['name'])) {
        $upload_dir = "../_static/uploads/";

        $filename = uniqid() . "_" . basename($_FILES["cover"]["name"]);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover_path = "/_static/uploads/" . $filename;
        }
    }

	$stmt = $pdo->prepare("
        INSERT INTO app.playlists
        (user_id, name, description, cover_image)
        VALUES (:user_id, :name, :description, :cover_image)
    ");

    $stmt->execute([
        ':user_id'     => $user_id,
        ':name'        => $request['name'],
        ':description' => $request['description'] ?? null,
        ':cover_image' => $cover_path,
    ]);

    return header("Location: template/list_playlist.php");
}

function update_playlist($request, $pdo) {
	$cover_path = null;
	if (!empty($_FILES['cover']['name'])) {
        $upload_dir = "../_static/uploads/";

        $filename = uniqid() . "_" . basename($_FILES["cover"]["name"]);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover_path = "/_static/uploads/" . $filename;
        }
	}

	$stmt = $pdo->prepare(
		"UPDATE app.playlists SET name = ?, description = ?" . 
		($cover_path ? ", cover = ?" : "") .
		" WHERE id = ?"
	);

	if ($cover_path) {
		$stmt->execute([
			$request['name'], $request['description'],
			$cover_path, $request['id']
		]);
	} else {
		$stmt->execute([
			$request['name'], $request['description'], 
			$request['id']
		]);
	}

    return header("Location: template/list_playlist.php");
}

function delete_playlist($request, $pdo) {
	$id = (int) $_POST['id'];
	$stmt = $pdo->prepare("DELETE FROM app.playlists WHERE id = ?");
	$stmt->execute([$id]);
    return header("Location: template/list_playlist.php");
}

function get_user_playlists($pdo) {
    //session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM app.playlists WHERE user_id = :uid ORDER BY created_at DESC");
    $stmt->execute([':uid' => $user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function playlist_detail($request, $pdo) {
    session_start();
	
	if (!isset($_SESSION['user_id'])) {
        header("Location: /users/template/login.php");
        exit;
    }

	$id = (int) $request['id'];
	$stmt = $pdo->prepare("SELECT * FROM app.playlists WHERE id = ?");
    $stmt->execute([$id]);
    $playlist = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT * FROM app.musics WHERE playlist_id = ?
        ORDER BY added_at DESC
    ");
    $stmt->execute([$id]);
    $musics = get_playlist_embed_link($stmt->fetchAll(PDO::FETCH_ASSOC));

    include "template/playlist_detail.php";
}

function get_playlist_embed_link($rows) {
	foreach ($rows as &$row) {
        $parts = explode("track/", $row['link']);

        if (isset($parts[1])) {
            $row['embed_link'] = $parts[1];
        } else {
            $row['embed_link'] = "";
        }
    }
    return $rows;
}

function add_music_to_playlist($request, $pdo) {
	$stmt = $pdo->prepare("
        INSERT INTO app.musics
        (playlist_id, link)
        VALUES (?, ?)
    ");
	$stmt->execute([$request['playlist_id'], $request['link']]);
	header("Location: /playlists/url.php?url=playlist_details&id=" . $request['playlist_id']);
}

function delete_music($request, $pdo) {
	$id = (int)$request['id'];
	$stmt = $pdo->prepare("DELETE FROM app.musics WHERE id = ?");
	$stmt->execute([$id]);
	header("Location: /playlists/url.php?url=playlist_details&id=" . $request['playlist_id']);
}
