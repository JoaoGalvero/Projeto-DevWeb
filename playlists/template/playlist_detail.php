<html lang="pt-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="../../_static/css/playlists.css">
	<link rel="stylesheet" href="../../_static/css/base_bootstrap.css">
	<title>Playlists</title>
</head>
<body>
	<nav class="navbar bg-body-tertiary">
	  <div class="container-fluid">
		<a class="navbar-brand" href="#">AUDIO·ANG3L LIBRARY·01</a>
	  </div>
	</nav>
	<div class="container my-4">
		<div class="row mb-2">
			<div class="col-auto">
			<?php if ($playlist['cover_image']): ?>
				<img src="<?= htmlspecialchars($playlist['cover_image']) ?>" 
					class="playlist-img-detail"
					alt="Capa">
			<?php else: ?>
				<img src="../_static/default_cover.png" 
					class="playlist-img-detail"
					alt="Capa padrão">
			<?php endif; ?>
			</div>
			<div class="col d-flex flex-row justify-content-between align-items-end">
				<div>
					<h1 class="m-0"><?= htmlspecialchars($playlist['name'])?></h1>
					<p class="card-text"><?= htmlspecialchars($playlist['description'])?></p>
				</div>
				<div class="btn-group w-25" role="group">
					<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					  Adicionar Música
					</button>
					<div class="dropdown-menu p-2">
						<form action="/playlists/url.php" method="POST">
							<input type="hidden" name="url" value="add_music_to_playlist">
							<input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
							<div class="mb-3">
								<label for="playlist-name" class="form-label">Link:</label>
								<input type="text" class="form-control" id="music-link" name="link" placeholder="Digite o link">
							</div>
							<button type="submit" class="btn btn-primary">Salvar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php foreach ($musics as $m): ?>
			<div class="col">
				<div class="row">
					<div class="col-auto">
						<iframe data-testid="embed-iframe" style="border-radius:12px;"
						src="https://open.spotify.com/embed/track/<?= htmlspecialchars($m['embed_link'])?>?utm_source=generator&theme=0"
						width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
					</div>
					<div class="col-auto d-flex align-items-center justify-content-center">
						<form class="m-0" action="/playlists/url.php" method="POST">
							<input type="hidden" name="url" value="delete_music">
							<input type="hidden" name="id" value="<?= $m["id"] ?>">
							<input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
							<button type="submit" class="btn btn-link p-0 text-danger">
								<i class="bi bi-trash-fill"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
