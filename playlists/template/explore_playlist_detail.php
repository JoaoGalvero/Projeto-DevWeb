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
	<?php include 'nav.php'?>
	<div class="container my-4">
		<div class="row mb-2 playlist-menu p-4">
			<div class="col-auto">
			<?php if ($playlist['cover_image']): ?>
				<img src="<?= htmlspecialchars($playlist['cover_image']) ?>" 
					class="playlist-img-detail"
					alt="Capa">
			<?php else: ?>
				<img src="/_static/assets/music_cover.png" 
					class="playlist-img-detail"
					alt="Capa padrão">
			<?php endif; ?>
			</div>
			<div class="col d-flex flex-row justify-content-between align-items-end">
				<div>
					<h1 class="m-0"><?= htmlspecialchars($playlist['name'])?></h1
					<p class="card-text"><?= htmlspecialchars($playlist['description'])?></p>
				</div>
			</div>
		</div>
		<div class="row row-cols-1 row-cols-md-3 g-4 p-2 mx-auto">
			<?php foreach ($musics as $m): ?>
			<div class="col">
				<div class="row">
					<div class="col-auto">
						<iframe data-testid="embed-iframe" style="border-radius:12px;"
						src="https://open.spotify.com/embed/track/<?= htmlspecialchars($m['embed_link'])?>?utm_source=generator&theme=0"
						width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
