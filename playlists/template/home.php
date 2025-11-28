<!DOCTYPE html>
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
		<div class="row align-items-center mb-2 playlist-menu p-2">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center my-4">
				<h2>Bem-vindo, <?= htmlspecialchars($username); ?></h2>
				<p><?= htmlspecialchars($email); ?></p>
			</div>
		</div>
		<hr>
		<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
			<?php include "explore_playlist_card.php";?>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
