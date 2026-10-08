import { readSectionData, filterSectionOptions } from './section-filter';

export default function initCreateContactModal() {
  const modal = document.getElementById('modalCreateContact');
  const form = document.getElementById('createContactForm');

  if (!modal || !form) return;

  const data = readSectionData(modal);
  const generalSelect = document.getElementById('generalCategoryContact');
  const activeSelect = document.getElementById('isActiveContact');

  const applyFilter = () => {
    filterSectionOptions(generalSelect, data, { onlyAvailable: activeSelect?.value === '1' });
  };

  activeSelect?.addEventListener('change', applyFilter);

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    activeSelect?.tomselect?.clear();
    applyFilter();
  });
}
