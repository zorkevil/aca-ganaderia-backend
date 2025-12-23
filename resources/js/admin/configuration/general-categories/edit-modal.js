export default function initEditGeneralCategoryModal() {
  const modal = document.getElementById('modalEditGeneralCategory');
  const form = document.getElementById('editGeneralCategoryForm');

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
    setFieldValue('editNameGeneralCategories', btn.dataset.name);
    setFieldValue('editDescriptionGeneralCategories', btn.dataset.description);
    setFieldValue('editSlugGeneralCategories', btn.dataset.slug);
    setFieldValue('editIconAltGeneralCategories', btn.dataset.icon_alt);

    // 4. Estado (TomSelect)
    const activeSelect = document.getElementById('editIsActiveGeneralCategories');
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
    const activeSelect = document.getElementById('editIsActiveGeneralCategories');
    if (activeSelect?.tomselect) {
      activeSelect.tomselect.clear();
    }
  });
}
