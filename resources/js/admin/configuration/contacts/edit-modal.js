export default function initEditContactModal() {
  const modal = document.getElementById('modalEditContact');
  const form = document.getElementById('editContactForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1) action dinámica
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // 2) inputs
    setFieldValue('editNameContact', btn.dataset.name);
    setFieldValue('editPhoneContact', btn.dataset.phone);

    // 3) sección (tomselect)
    const generalSelect = document.getElementById('editGeneralCategoryContact');
    if (generalSelect) {
      const v = btn.dataset.general_category_id || '';
      generalSelect.value = v;

      if (generalSelect.tomselect) {
        // tomselect espera string
        generalSelect.tomselect.setValue(v ? String(v) : '');
      }
    }

    // 4) estado (tomselect)
    const activeSelect = document.getElementById('editIsActiveContact');
    if (activeSelect) {
      const v = btn.dataset.is_active !== undefined ? btn.dataset.is_active : '1';
      activeSelect.value = v;

      if (activeSelect.tomselect) {
        activeSelect.tomselect.setValue(String(v));
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    // opcional: limpiar tomselect
    const generalSelect = document.getElementById('editGeneralCategoryContact');
    if (generalSelect?.tomselect) {
      generalSelect.tomselect.clear();
    }

    const activeSelect = document.getElementById('editIsActiveContact');
    if (activeSelect?.tomselect) {
      activeSelect.tomselect.clear();
    }
  });
}
