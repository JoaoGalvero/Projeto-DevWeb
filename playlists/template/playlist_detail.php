<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../_core/connection.php";
require_once __DIR__ . "/../view.php";

if (!isset($_GET['id'])) {
    die("ID da playlist não informado.");
}

$pdo = db();
$id = (int) $_GET['id'];

// Busca playlist
$stmt = $pdo->prepare("SELECT * FROM app.playlists WHERE id = ?");
$stmt->execute([$id]);
$playlist = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$playlist) {
    die("Playlist não encontrada.");
}

// Busca músicas
$stmt = $pdo->prepare("SELECT * FROM app.musics WHERE playlist_id = ? ORDER BY added_at DESC");
$stmt->execute([$id]);
$musics = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($playlist['name']) ?> - AAL01</title>
    <link rel="stylesheet" href="../../_static/css/padrao.css">
    <link rel="stylesheet" href="../../_static/css/home.css">
    <link rel="stylesheet" href="../../_static/css/playlist_detail.css">
    <link rel="icon" type="image/x-icon" href="../../_static/assets/favicon.ico">
</head>
<body>

    <button class="btn-voltar" onclick="window.location.href='./home.php'">← Voltar</button>


    <div class="playlist-detail-container">
        <div class="playlist-detail-cover">
            <?php if (!empty($playlist['cover_image'])): ?>
                <img src="<?= htmlspecialchars($playlist['cover_image']) ?>" alt="Capa da playlist">
            <?php else: ?>
                <img src="../../_static/assets/default_cover.png" alt="Capa padrão">
            <?php endif; ?>
        </div>

        <h2 class="playlist-detail-title"><?= htmlspecialchars($playlist['name']) ?></h2>
        <p class="playlist-detail-description"><?= htmlspecialchars($playlist['description']) ?></p>

        <form class="add-music-form" action="../url.php" method="POST">
            <input type="hidden" name="url" value="add_music_to_playlist">
            <input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
            <input type="text" name="link" placeholder="Link da música (Spotify)" required>
            <button type="submit">Adicionar Música</button>
        </form>

        <div class="music-list">
            <?php if (!empty($musics)): ?>
                <?php foreach ($musics as $m): ?>
                    <?php
                        // Extrai o ID do link do Spotify (se vier link completo)
                        $embedId = '';
                        if (strpos($m['link'], 'track/') !== false) {
                            $parts = explode('track/', $m['link']);
                            $embedId = explode('?', $parts[1])[0];
                        } else {
                            $embedId = trim($m['link']);
                        }
                    ?>
                    <div class="music-item">
                        <iframe 
                            src="https://open.spotify.com/embed/track/<?= htmlspecialchars($embedId) ?>?utm_source=generator&theme=0"
                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                            loading="lazy">
                        </iframe>

                        <form action="../url.php" method="POST" class="delete-music-form">
                            <input type="hidden" name="url" value="delete_music">
                            <input type="hidden" name="id" value="<?= $m['id'] ?>">
                            <input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
                            <button type="submit" class="btn-delete">x</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-music">Nenhuma música adicionada ainda.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        <p>© 2025 AUDIO·ANG3L LIBRARY·01 — CRIADO POR PEDRO GALVERO E KAUAI TÁVORA APENAS PARA USO EDUCATIVO — AAL01</p>
    </footer>
</body>
</html>
