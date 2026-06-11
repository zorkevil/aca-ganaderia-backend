import { hookSemillasSubcategory, populateSemillasEditFields, getGroupFromSelect, applyGroup } from './semillas-fields.js';

export function initCreateProductoSemillasModal() {
  const modal = document.getElementById('modalProductoSemillas');
  if (!modal) return;

  // Deshabilita todos los grupos desde el inicio (ninguno seleccionado)
  applyGroup('createSemillasFields', null, false);

  // Engancha el switch de subcategoría una vez que TomSelect ya está inicializado
  hookSemillasSubcategory('createSemillasSubcategory', 'createSemillasFields');

  // Al cerrar, limpia campos dinámicos
  modal.addEventListener('hidden.bs.modal', () => {
    applyGroup('createSemillasFields', null, true);

    const subcategory = document.getElementById('createSemillasSubcategory');
    if (subcategory?.tomselect) subcategory.tomselect.clear();

    const isActive = modal.querySelector('[name="is_active"]');
    if (isActive?.tomselect) isActive.tomselect.clear();
  });
}

export function initEditProductoSemillasModal() {
  const modal = document.getElementById('modalEditarProductoSemillas');
  const form  = document.getElementById('formEditarProductoSemillas');

  if (!modal || !form) return;

  hookSemillasSubcategory('editSemillasSubcategory', 'editSemillasFields');

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) form.action = tpl.replace('__ID__', id);

    const setVal = (elId, val) => {
      const el = document.getElementById(elId);
      if (el) el.value = val ?? '';
    };

    setVal('editSemillasName',        btn.dataset.name);
    setVal('editSemillasTitle',       btn.dataset.title);
    setVal('editSemillasSubtitle',    btn.dataset.subtitle);
    setVal('editSemillasSlug',        btn.dataset.slug);
    setVal('editSemillasSku',         btn.dataset.sku);
    setVal('editSemillasDescription', btn.dataset.description);
    setVal('editSemillasImageAlt',    btn.dataset.image_alt);
    setVal('editSemillasDate',        btn.dataset.date);

    const subcategoryEl = document.getElementById('editSemillasSubcategory');
    if (subcategoryEl?.tomselect) {
      subcategoryEl.tomselect.setValue(btn.dataset.subcategory_id || '');
    }

    const activeEl = document.getElementById('editSemillasIsActive');
    if (activeEl?.tomselect) {
      activeEl.tomselect.setValue(btn.dataset.is_active ?? '1');
    }

    // Detecta el grupo por la opción seleccionada y muestra los campos correspondientes
    const group = getGroupFromSelect(subcategoryEl, btn.dataset.subcategory_id || '');
    applyGroup('editSemillasFields', group, false);

    populateSemillasEditFields(group, {
      ciclo:               btn.dataset.ciclo,
      aptitud_de_uso:      btn.dataset.aptitud_de_uso,
      contenido_de_tanino: btn.dataset.contenido_de_tanino,
      calidad_de_ms:       btn.dataset.calidad_de_ms,
      perfil_sanitario:    btn.dataset.perfil_sanitario,
      altura_cm:           btn.dataset.altura_cm,
      despeje_de_panoja:   btn.dataset.despeje_de_panoja,
      bmr:                 btn.dataset.bmr,
      porcentaje_de_panoja:btn.dataset.porcentaje_de_panoja,
      zona_de_adaptacion:  btn.dataset.zona_de_adaptacion,
      densidad_de_siembra: btn.dataset.densidad_de_siembra,
      tecnologia:          btn.dataset.tecnologia,
      madurez_relativa:    btn.dataset.madurez_relativa,
      comportamiento_a_vuelco_y_quebrado: btn.dataset.comportamiento_a_vuelco_y_quebrado,
      velocidad_de_secado: btn.dataset.velocidad_de_secado,
      textura_de_grano:    btn.dataset.textura_de_grano,
    });
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    applyGroup('editSemillasFields', null, true);

    ['editSemillasSubcategory', 'editSemillasIsActive'].forEach(id => {
      const el = document.getElementById(id);
      if (el?.tomselect) el.tomselect.clear();
    });
  });
}

export function initEditProductoIdentElectronicaModal() {
  const modal = document.getElementById('modalEditarProductoIdentElectronica');
  const form  = document.getElementById('formEditarProductoIdentElectronica');

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

    setVal('editIdentElectronicaName', btn.dataset.name);
    setVal('editIdentElectronicaTitle', btn.dataset.title);
    setVal('editIdentElectronicaSubtitle', btn.dataset.subtitle);
    setVal('editIdentElectronicaSlug', btn.dataset.slug);
    setVal('editIdentElectronicaSku', btn.dataset.sku);
    setVal('editIdentElectronicaDescription', btn.dataset.description);
    setVal('editIdentElectronicaImageAlt', btn.dataset.image_alt);
    setVal('editIdentElectronicaDate', btn.dataset.date);

    const subcategory = document.getElementById('editIdentElectronicaSubcategory');
    if (subcategory?.tomselect) {
      subcategory.tomselect.setValue(btn.dataset.subcategory_id || '');
    }

    const active = document.getElementById('editIdentElectronicaIsActive');
    if (active?.tomselect) {
      active.tomselect.setValue(btn.dataset.is_active ?? '1');
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    ['editIdentElectronicaSubcategory', 'editIdentElectronicaIsActive'].forEach(id => {
      const el = document.getElementById(id);
      if (el?.tomselect) el.tomselect.clear();
    });
  });
}

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
