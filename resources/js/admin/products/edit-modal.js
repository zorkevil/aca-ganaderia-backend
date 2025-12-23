export function initEditProductoNutricionModal() {
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

export function initEditProductoSanidadModal() {
  const modal = document.getElementById('modalEditarProductoSanidad');
  const form  = document.getElementById('formEditarProductoSanidad');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    const setVal = (id, val) => {
      const el = document.getElementById(id);
      if (el) el.value = val ?? '';
    };

    setVal('editSanidadName', btn.dataset.name);
    setVal('editSanidadTitle', btn.dataset.title);
    setVal('editSanidadSubtitle', btn.dataset.subtitle);
    setVal('editSanidadSlug', btn.dataset.slug);
    setVal('editSanidadSku', btn.dataset.sku);
    setVal('editSanidadDescription', btn.dataset.description);
    setVal('editSanidadSenasa', btn.dataset.senasa);
    setVal('editSanidadPresentation', btn.dataset.presentation);
    setVal('editSanidadAdministration', btn.dataset.administration);
    setVal('editSanidadFormula', btn.dataset.formula);
    setVal('editSanidadDosage', btn.dataset.dosage);
    setVal('editSanidadImageAlt', btn.dataset.image_alt);
    setVal('editSanidadDate', btn.dataset.date);

    const category = document.getElementById('editSanidadCategory');
    if (category?.tomselect) {
      category.tomselect.setValue(btn.dataset.category_id || '');
    }

    const subcategory = document.getElementById('editSanidadSubcategory');
    if (subcategory?.tomselect) {
      subcategory.tomselect.setValue(btn.dataset.subcategory_id || '');
    }

    const active = document.getElementById('editSanidadIsActive');
    if (active?.tomselect) {
      active.tomselect.setValue(btn.dataset.is_active ?? '1');
    }

    modal.querySelectorAll('.especie-check').forEach(chk => chk.checked = false);

    if (btn.dataset.especie_animal) {
      btn.dataset.especie_animal
        .split(',')
        .map(e => e.trim().toLowerCase())
        .forEach(especie => {
          const el = document.getElementById(`editSanidadEspecie_${especie}`);
          if (el) el.checked = true;
        });
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    ['editSanidadCategory', 'editSanidadSubcategory', 'editSanidadIsActive'].forEach(id => {
      const el = document.getElementById(id);
      if (el?.tomselect) el.tomselect.clear();
    });

    modal.querySelectorAll('.especie-check').forEach(chk => chk.checked = false);
  });
}
