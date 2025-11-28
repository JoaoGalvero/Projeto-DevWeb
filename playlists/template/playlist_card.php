<?php foreach ($playlists as $p): ?>
  <div class="playlist-card">
    <a href="../url.php?url=playlist_details&id=<?= $p['id'] ?>">
      <?php if ($p['cover_image']): ?>
        <img src="<?= htmlspecialchars($p['cover_image']) ?>" alt="Capa da playlist">
      <?php else: ?>
        <img src="../_static/default_cover.png" alt="Capa padrão">
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
        <button class="edit-btn" onclick='openEditModal(<?= json_encode($p)?>)'>✎</button>
      </div>
    </div>
  </div>
<?php endforeach; ?>