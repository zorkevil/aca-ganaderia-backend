export default function initEditAuctionTypeModal() {
  const modal = document.getElementById('modalEditAuctionType');
  const form = document.getElementById('editAuctionTypeForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1. Action del form (URL dinámica)
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Helper para setear valores
    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // 3. Campos
    setFieldValue('editNameAuctionTypes', btn.dataset.name);
    setFieldValue('editSlugAuctionTypes', btn.dataset.slug);

    // 4. Estado (TomSelect)
    const activeSelect = document.getElementById('editIsActiveAuctionTypes');
    if (activeSelect) {
      const activeValue =
        btn.dataset.is_active !== undefined ? btn.dataset.is_active : '1';

      activeSelect.value = activeValue;

      if (activeSelect.tomselect) {
        activeSelect.tomselect.setValue(activeValue);
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    // Reset TomSelect si existe
    const activeSelect = document.getElementById('editIsActiveAuctionTypes');
    if (activeSelect?.tomselect) {
      activeSelect.tomselect.clear();
    }
  });
}
