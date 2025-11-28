<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "../../_core/connection.php";
require "../view.php";

$pdo = db();
$playlists = get_user_playlists($pdo);
$username = get_user_name($pdo);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../../_static/css/padrao.css">
  <link rel="stylesheet" href="../../_static/css/home.css">
  <link rel="icon" type="image/x-icon" href="../../_static/assets/favicon.ico">
  <title>Home</title>
</head>
<body>
  <header class="profile-header">
    <button class="btn-sair" onclick="window.location.href='../../users/url.php?url=logout_user'">Exit</button>
    <button class="btn-edit">✎</button>
    <div class="profile-image"></div>
    <h1 class="profile-name"><?= htmlspecialchars($username) ?></h1>
    <p class="profile-bio">biografia</p>
  </header>

  <!-- MODAL CRIAR PLAYLIST -->
  <div class="modal" id="playlist-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <h2>Nova Playlist</h2>

        <form id="playlist-form" action="../url.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="url" value="create_playlist">

          <label for="playlist-name">Nome da Playlist</label>
          <input type="text" id="playlist-name" name="name" placeholder="Digite o nome" required>

          <label for="playlist-cover">Capa da Playlist</label>
          <label for="playlist-cover" class="file-upload-label">Escolher arquivo</label>
          <input type="file" id="playlist-cover" name="cover" accept="image/*">

          <label for="playlist-description">Descrição</label>
          <textarea id="playlist-description" name="description" rows="3" placeholder="Escreva algo sobre a playlist..."></textarea>

          <div class="modal-buttons">
            <button type="button" class="btn-cancel modal-close">Cancelar</button>
            <button type="submit" class="btn-confirm">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL EDITAR PLAYLIST -->
  <div class="modal" id="editPlaylistModal">
    <div class="modal-content">
      <h2>Editar Playlist</h2>

      <form id="edit-playlist-form" action="../url.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="url" value="update_playlist">
        <input type="hidden" name="id" id="edit-playlist-id">

        <label for="edit-playlist-name">Nome da Playlist</label>
        <input type="text" id="edit-playlist-name" name="name" placeholder="Digite o nome">

        <label for="edit-playlist-cover">Capa da Playlist</label>
        <label for="edit-playlist-cover" class="file-upload-label">Escolher arquivo</label>
        <input type="file" id="edit-playlist-cover" name="cover" accept="image/*">

        <label for="edit-playlist-description">Descrição</label>
        <textarea id="edit-playlist-description" name="description" rows="3" placeholder="Escreva algo sobre a playlist..."></textarea>

        <div class="modal-buttons">
          <button type="button" class="btn-cancel modal-close">Cancelar</button>
          <button type="submit" class="btn-confirm">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <section class="playlist-box">
    <div class="playlist-collection">
      <?php if (!empty($playlists)): ?>
        <?php foreach ($playlists as $p): ?>
          <div class="playlist-card">
            <a href="playlist_detail.php?id=<?= $p['id'] ?>">
              <?php if ($p['cover_image']): ?>
                <img src="<?= htmlspecialchars($p['cover_image']) ?>" alt="Capa da playlist">
              <?php else: ?>
                <img src="../../_static/default_cover.png" alt="Capa padrão">
              <?php endif; ?>
            </a>
            <div class="playlist-info">
              <h3><?= htmlspecialchars($p['name']) ?></h3>
              <p><?= htmlspecialchars($p['description']) ?></p>
              <div class="playlist-actions">
                <form action="../url.php" method="POST" onsubmit="return confirm('Excluir esta playlist?');">
                  <input type="hidden" name="url" value="delete_playlist">
                  <input type="hidden" name="id" value="<?= $p['id'] ?>">
                  <button type="submit" class="delete-btn">🗑</button>
                </form>
                <button class="edit-btn" onclick='openEditModal(<?= json_encode($p) ?>)'>✎</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no-playlists">Nenhuma playlist encontrada.</p>
      <?php endif; ?>
      <div class="btn-playlists" data-modal-target="#playlist-modal">+</div>
    </div>
  </section>

  <footer class="footer">
    <p>© 2025 AUDIO·ANG3L LIBRARY·01 — CRIADO POR PEDRO GALVERO E KAUAI TÁVORA APENAS PARA USO EDUCATIVO — AAL01</p>
  </footer>

  <script src="../../_static/app/modal_manager.js"></script>

  <script>
    // Atualiza o texto do botão "Escolher arquivo"
    document.querySelectorAll('input[type="file"]').forEach(input => {
      const label = input.previousElementSibling;
      input.addEventListener('change', e => {
        const fileName = e.target.files[0]?.name || "Escolher arquivo";
        label.textContent = fileName.length > 20 ? fileName.slice(0, 20) + "..." : fileName;
      });
    });
  </script>
</body>
</html>
