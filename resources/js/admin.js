import * as bootstrap from 'bootstrap';

import { initTomSelect } from './admin/helpers/tom-select';
import { initQuillBasic } from './admin/helpers/quill-basic';

import initSidebar from './admin/layout/sidebar';
import initAccordionTabs from './admin/layout/tabs';

import initEditSliderModal from './admin/home/sliders/edit-modal';
import { initEditReportModal, initEditMarketPresenterModal } from './admin/reports/edit-modal';
import initEditGeneralCategoryModal from './admin/configuration/general-categories/edit-modal';
import initEditCategoryModal from './admin/configuration/categories/edit-modal';
import initEditSubcategoryModal from './admin/configuration/subcategories/edit-modal';
import initEditMainBannerModal from './admin/configuration/main-banner/edit-modal';
import initEditNutritionServiceModal from './admin/configuration/service/edit-modal';
import initEditContactModal from './admin/configuration/contacts/edit-modal';
import { initEditProductoNutricionModal, initEditProductoSanidadModal } from './admin/products/edit-modal';
import { initEditAllianceModal, initEditAllianceTextModal } from './admin/configuration/alliances/edit-modal';
import initEditAuctionModalityModal from './admin/configuration/auction-modality/edit-modal';
import initEditAuctionTypeModal from './admin/configuration/auction-type/edit-modal';
import { initEditAuctionModal, initEditAuctionTextModal } from './admin/configuration/auctions/edit-modal';

import initDeleteModal from './admin/shared/delete-modal';

document.addEventListener('DOMContentLoaded', () => {
  initSidebar();
  initAccordionTabs();

  initTomSelect();
  initQuillBasic();

  initEditSliderModal();
  initEditMarketPresenterModal();
  initEditReportModal();
  initEditGeneralCategoryModal();
  initEditCategoryModal();
  initEditSubcategoryModal();
  initEditMainBannerModal();
  initEditNutritionServiceModal();
  initEditProductoNutricionModal();
  initEditProductoSanidadModal();
  initEditContactModal();
  initEditAllianceModal();
  initEditAllianceTextModal();
  initEditAuctionModalityModal();
  initEditAuctionTypeModal();
  initEditAuctionModal();
  initEditAuctionTextModal();

  initDeleteModal();
});

document.addEventListener('shown.bs.modal', (event) => {
  initTomSelect(event.target);
  initQuillBasic(event.target);
});
