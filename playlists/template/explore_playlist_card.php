<?php foreach ($playlists as $p): ?>
	<div class="col">
		<div class="card small-card h-100">
			<a href="/playlists/url.php?url=explore_playlist_detail&id=<?=$p['id']?>" class="text-decoration-none">
			<?php if ($p['cover_image']): ?>
				<img src="<?= htmlspecialchars($p['cover_image']) ?>" 
					class="card-img-top playlist-img-list"
					alt="Capa">
			<?php else: ?>
				<img src="/_static/assets/music_cover.png" 
					class="card-img-top playlist-img-list"
					alt="Capa padrão">
			<?php endif; ?>
			</a>
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
					<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						...
					</button>
				</div>	
				<p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
