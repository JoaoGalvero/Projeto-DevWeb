<div class="modal fade" id="playlist-modal" tabindex="-1" aria-labelledby="playlistModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="playlistModalLabel">Criar Nova Playlist</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="playlist-form" action="../url.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="url" value="create_playlist">
				<div class="modal-body">
					<div class="mb-3">
						<label for="playlist-name" class="form-label">Nome da Playlist</label>
						<input type="text" class="form-control" id="playlist-name" name="name" placeholder="Digite o nome">
					</div>

					<div class="mb-3">
						<label for="playlist-cover" class="form-label">Capa da Playlist</label>
						<input type="file" class="form-control" id="playlist-cover" name="cover" accept="image/*">
					</div>
					<div class="mb-3">
						<label for="playlist-description" class="form-label">Descrição</label>
						<textarea class="form-control" id="playlist-description" name="description" rows="3" placeholder="Escreva algo sobre a playlist..."></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

