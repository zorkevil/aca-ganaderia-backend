import * as bootstrap from 'bootstrap';

import { initTomSelect } from './admin/helpers/tom-select';
import { initQuillBasic } from './admin/helpers/quill-basic';

import initSidebar from './admin/layout/sidebar';
import initAccordionTabs from './admin/layout/tabs';

import initEditSliderModal from './admin/home/sliders/edit-modal';
import { initEditReportModal, initEditMarketPresenterModal } from './admin/reports/edit-modal';

import initDeleteModal from './admin/shared/delete-modal';

document.addEventListener('DOMContentLoaded', () => {
  initSidebar();
  initAccordionTabs();

  initTomSelect();
  initQuillBasic();

  initEditSliderModal();
  initEditMarketPresenterModal();
  initEditReportModal();

  initDeleteModal();
});

document.addEventListener('shown.bs.modal', (event) => {
  initTomSelect(event.target);
  initQuillBasic(event.target);
});
