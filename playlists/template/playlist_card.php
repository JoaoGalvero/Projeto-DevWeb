<?php foreach ($playlists as $p): ?>
	<div class="col">
		<div class="card">
			<?php if ($p['cover_image']): ?>
				<img src="<?= htmlspecialchars($p['cover_image']) ?>" 
					class="card-img-top"
					alt="Capa">
			<?php else: ?>
				<img src="../_static/default_cover.png" 
					class="card-img-top"
					alt="Capa padrão">
			<?php endif; ?>
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
					<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						...
					</button>
					<ul class="dropdown-menu dropdown-menu-dark">
						<li>
							<form action="../url.php" method="POST" class="m-0" onsubmit="return confirm('Excluir esta playlist?');">
								<input type="hidden" name="url" value="delete_playlist">
								<input type="hidden" name="id" value="<?= $p['id'] ?>">
								<button type="submit" class="dropdown-item" href="#">Excluir playlist</button>
							</form>
						</li>
						<li>
							<button class="dropdown-item" onclick='openEditModal(<?= json_encode($p)?>)'>
								Editar propriedades
							</button>
						</li>
					</ul>
				</div>	
				<p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
