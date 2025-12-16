export default function initDeleteModal() {
  const modal = document.getElementById('modalEliminar');
  const form = document.getElementById('deleteForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    const action = btn.dataset.action;
    if (!action) return;

    form.action = action;
  });
}
