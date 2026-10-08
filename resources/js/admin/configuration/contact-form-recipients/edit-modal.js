import { readSectionData, filterSectionOptions } from '../contacts/section-filter';

export default function initEditContactFormRecipientModal() {
  const modal = document.getElementById('modalEditContactFormRecipient');
  const form = document.getElementById('editContactFormRecipientForm');

  if (!modal || !form) return;

  const data = readSectionData(modal);
  const emailInput = document.getElementById('editEmailRecipient');
  const sectionSelect = document.getElementById('editSectionRecipient');
  const activeSelect = document.getElementById('editIsActiveRecipient');
  const warning = document.getElementById('editContactFormRecipientActiveWarning');

  let recipientId = null;

  const applyFilter = () => {
    filterSectionOptions(sectionSelect, data, {
      onlyAvailable: activeSelect?.value === '1',
      contactId: recipientId,
    });
  };

  activeSelect?.addEventListener('change', applyFilter);

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    recipientId = btn.dataset.id;

    // 1) action dinámica
    const tpl = form.dataset.actionTemplate;
    if (recipientId && tpl) {
      form.action = tpl.replace('__ID__', recipientId);
    }

    // 2) email
    if (emailInput) emailInput.value = btn.dataset.email ?? '';

    // 3) estado, antes que la sección porque define qué secciones se muestran
    const isActive = btn.dataset.is_active !== undefined ? String(btn.dataset.is_active) : '1';
    if (activeSelect) {
      activeSelect.value = isActive;
      activeSelect.tomselect?.setValue(isActive);
    }

    // 4) sección
    const section = btn.dataset.section || '';
    applyFilter();
    sectionSelect?.tomselect?.setValue(section);

    // 5) aviso si la sección ya tiene otro email activo
    const active = data.activeBySection[section];
    const blocked = isActive === '0' && active && String(active.id) !== String(recipientId);
    if (warning) {
      warning.classList.toggle('d-none', !blocked);
      const nameEl = warning.querySelector('[data-active-name]');
      if (nameEl) nameEl.textContent = blocked ? active.name : '';
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    recipientId = null;
    warning?.classList.add('d-none');

    sectionSelect?.tomselect?.clear();
    activeSelect?.tomselect?.clear();
  });
}
