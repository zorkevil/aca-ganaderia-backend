export default function initEditCategoryModal() {
  const modal = document.getElementById('modalEditCategory');
  const form = document.getElementById('editCategoryForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // Action
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    const set = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    set('editCategoryName', btn.dataset.name);
    set('editCategorySlug', btn.dataset.slug);
    set('editCategoryIconAlt', btn.dataset.icon_alt);

    // General Category
    const gc = document.getElementById('editCategoryGeneralCategory');
    if (gc) {
      gc.value = btn.dataset.general_category_id;
      if (gc.tomselect) {
        gc.tomselect.setValue(btn.dataset.general_category_id);
      }
    }

    // Estado
    const active = document.getElementById('editCategoryActive');
    if (active) {
      active.value = btn.dataset.is_active;
      if (active.tomselect) {
        active.tomselect.setValue(btn.dataset.is_active);
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    ['editCategoryGeneralCategory', 'editCategoryActive'].forEach(id => {
      const el = document.getElementById(id);
      if (el?.tomselect) el.tomselect.clear();
    });
  });
}
