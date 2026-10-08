import { readSectionData, filterSectionOptions } from './section-filter';

export default function initEditContactModal() {
  const modal = document.getElementById('modalEditContact');
  const form = document.getElementById('editContactForm');

  if (!modal || !form) return;

  const data = readSectionData(modal);
  const generalSelect = document.getElementById('editGeneralCategoryContact');
  const activeSelect = document.getElementById('editIsActiveContact');
  const warning = document.getElementById('editContactActiveWarning');

  let contactId = null;

  const applyFilter = () => {
    filterSectionOptions(generalSelect, data, {
      onlyAvailable: activeSelect?.value === '1',
      contactId,
    });
  };

  activeSelect?.addEventListener('change', applyFilter);

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    contactId = btn.dataset.id;

    // 1) action dinámica
    const tpl = form.dataset.actionTemplate;
    if (contactId && tpl) {
      form.action = tpl.replace('__ID__', contactId);
    }

    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // 2) inputs
    setFieldValue('editNameContact', btn.dataset.name);
    setFieldValue('editPhoneContact', btn.dataset.phone);

    // 3) estado (tomselect), antes que la sección porque define qué secciones se muestran
    const isActive = btn.dataset.is_active !== undefined ? String(btn.dataset.is_active) : '1';
    if (activeSelect) {
      activeSelect.value = isActive;
      activeSelect.tomselect?.setValue(isActive);
    }

    // 4) sección (tomselect)
    const sectionId = btn.dataset.general_category_id || '';
    applyFilter();
    generalSelect?.tomselect?.setValue(sectionId);

    // 5) aviso si la sección ya tiene otro contacto activo
    const active = data.activeBySection[sectionId];
    const blocked = isActive === '0' && active && String(active.id) !== String(contactId);
    if (warning) {
      warning.classList.toggle('d-none', !blocked);
      const nameEl = warning.querySelector('[data-active-name]');
      if (nameEl) nameEl.textContent = blocked ? active.name : '';
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    contactId = null;
    warning?.classList.add('d-none');

    generalSelect?.tomselect?.clear();
    activeSelect?.tomselect?.clear();
  });
}
