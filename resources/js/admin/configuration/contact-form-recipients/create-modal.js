import { readSectionData, filterSectionOptions } from '../contacts/section-filter';

export default function initCreateContactFormRecipientModal() {
  const modal = document.getElementById('modalCreateContactFormRecipient');
  const form = document.getElementById('createContactFormRecipientForm');

  if (!modal || !form) return;

  const data = readSectionData(modal);
  const sectionSelect = document.getElementById('sectionRecipient');
  const activeSelect = document.getElementById('isActiveRecipient');

  const applyFilter = () => {
    filterSectionOptions(sectionSelect, data, { onlyAvailable: activeSelect?.value === '1' });
  };

  activeSelect?.addEventListener('change', applyFilter);

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    activeSelect?.tomselect?.clear();
    applyFilter();
  });
}
