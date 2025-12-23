export default function initEditProductoNutricionModal() {
  const modal = document.getElementById('modalEditProductoNutricion');
  const form  = document.getElementById('formEditProductoNutricion');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // Action dinámica
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // Helper
    const setVal = (id, val) => {
      const el = document.getElementById(id);
      if (el) el.value = val ?? '';
    };

    setVal('editName', btn.dataset.name);
    setVal('editTitle', btn.dataset.title);
    setVal('editSubtitle', btn.dataset.subtitle);
    setVal('editSlug', btn.dataset.slug);
    setVal('editSku', btn.dataset.sku);
    setVal('editDescription', btn.dataset.description);
    setVal('editPresentation', btn.dataset.presentation);
    setVal('editAdministration', btn.dataset.administration);
    setVal('editSecondCategory', btn.dataset.second_category);
    setVal('editDosage', btn.dataset.dosage);
    setVal('editImageAlt', btn.dataset.image_alt);
    setVal('editDate', btn.dataset.date);

    // Selects
    const category = document.getElementById('editCategory');
    if (category?.tomselect) {
      category.tomselect.setValue(btn.dataset.category_id || '');
    }

    const active = document.getElementById('editIsActive');
    if (active?.tomselect) {
      active.tomselect.setValue(btn.dataset.is_active ?? '1');
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    ['editCategory', 'editIsActive'].forEach(id => {
      const el = document.getElementById(id);
      if (el?.tomselect) el.tomselect.clear();
    });
  });
}
