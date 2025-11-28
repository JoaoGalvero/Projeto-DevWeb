document.addEventListener('DOMContentLoaded', () => {
  const modals = document.querySelectorAll('.modal');
  const openButtons = document.querySelectorAll('[data-modal-target]');
  const closeButtons = document.querySelectorAll('.modal-close');

  openButtons.forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();
      const target = document.querySelector(button.dataset.modalTarget);
      if (target && !target.classList.contains('active')) target.classList.add('active');
    });
  });

  closeButtons.forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();
      const modal = button.closest('.modal');
      if (modal) modal.classList.remove('active');
    });
  });

  modals.forEach(modal => {
    modal.addEventListener('click', e => {
      if (e.target === modal) modal.classList.remove('active');
    });
  });
});

function openEditModal(playlist) {
  const modal = document.getElementById('editPlaylistModal');
  if (!modal) return;
  document.getElementById('edit-playlist-id').value = playlist.id || '';
  document.getElementById('edit-playlist-name').value = playlist.name || '';
  document.getElementById('edit-playlist-description').value = playlist.description || '';
  modal.classList.add('active');
}
