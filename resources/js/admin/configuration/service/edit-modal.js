export default function initEditNutritionServiceModal() {
  const modal = document.getElementById('modalEditNutritionService');
  const form = document.getElementById('editNutritionServiceForm');

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

    // 2. Helper para setear campos
    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // 3. Campos simples
    setFieldValue('editNutritionServiceTitle', btn.dataset.title);
    setFieldValue('editNutritionServiceIconAlt', btn.dataset.icon_alt);

    // 4. Estado (TomSelect)
    const activeSelect = document.getElementById('editNutritionServiceIsActive');
    if (activeSelect) {
      const value = btn.dataset.is_active ?? '1';
      activeSelect.value = value;

      if (activeSelect.tomselect) {
        activeSelect.tomselect.setValue(value);
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    // Reset TomSelect
    const activeSelect = document.getElementById('editNutritionServiceIsActive');
    if (activeSelect?.tomselect) {
      activeSelect.tomselect.clear();
    }
  });
}
