export default function initEditSubcategoryModal() {
  const modal = document.getElementById('modalEditSubcategory');
  const form = document.getElementById('editSubcategoryForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1. Action dinámica del form
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Helper simple
    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // 3. Campos de texto
    setFieldValue('editSubcategoryName', btn.dataset.name);
    setFieldValue('editSubcategorySlug', btn.dataset.slug);
    setFieldValue('editSubcategoryIconAlt', btn.dataset.icon_alt);

    // 4. Categoría (TomSelect)
    const categorySelect = document.getElementById('editSubcategoryCategory');
    if (categorySelect) {
      const categoryId = btn.dataset.category_id;

      categorySelect.value = categoryId;

      if (categorySelect.tomselect) {
        categorySelect.tomselect.setValue(categoryId);
      }
    }

    // 5. Estado (TomSelect)
    const activeSelect = document.getElementById('editSubcategoryActive');
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

    // Limpiar TomSelects
    ['editSubcategoryCategory', 'editSubcategoryActive'].forEach((id) => {
      const el = document.getElementById(id);
      if (el && el.tomselect) {
        el.tomselect.clear();
      }
    });
  });
}
