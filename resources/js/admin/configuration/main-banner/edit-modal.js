export default function initEditMainBannerModal() {
  const modal = document.getElementById('modalEditMainBanner');
  const form = document.getElementById('editMainBannerForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    const section = btn.dataset.section;
    const tpl = form.dataset.actionTemplate;

    if (section && tpl) {
      form.action = tpl.replace('__SECTION__', section);
    }

    const altInput = document.getElementById('editMainBannerAlt');
    if (altInput) {
      altInput.value = btn.dataset.image_alt ?? '';
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
  });
}
