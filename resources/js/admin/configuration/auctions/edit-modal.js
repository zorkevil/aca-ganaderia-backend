export function initEditAuctionModal() {
  const modal = document.getElementById('modalEditarAuction');
  const form  = document.getElementById('editAuctionForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // -------------------------
    // Action del form
    // -------------------------
    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // Helper setter
    const set = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // -------------------------
    // Campos simples
    // -------------------------
    set('editTitle', btn.dataset.name);
    set('editDate', btn.dataset.date);
    set('editTime', btn.dataset.time);
    set('editDescription', btn.dataset.description);
    set('editImageAlt', btn.dataset.alt);
    set('editLink', btn.dataset.link);

    // -------------------------
    // Modalidad (tom-select)
    // -------------------------
    const modality = document.getElementById('editModality');
    if (modality) {
      modality.value = btn.dataset.auction_modality_id ?? '';
      if (modality.tomselect) {
        modality.tomselect.setValue(btn.dataset.auction_modality_id ?? '');
      }
    }

    // -------------------------
    // Tipo (tom-select)
    // -------------------------
    const type = document.getElementById('editType');
    if (type) {
      type.value = btn.dataset.type_id ?? '';
      if (type.tomselect) {
        type.tomselect.setValue(btn.dataset.type_id ?? '');
      }
    }

    // -------------------------
    // Estado (tom-select)
    // -------------------------
    const active = document.getElementById('editActive');
    if (active) {
      active.value = btn.dataset.active;
      if (active.tomselect) {
        active.tomselect.setValue(btn.dataset.active);
      }
    }
  });

  // -------------------------
  // Al cerrar el modal
  // -------------------------
  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    ['editModality', 'editType', 'editActive'].forEach((id) => {
      const el = document.getElementById(id);
      if (el?.tomselect) {
        el.tomselect.clear();
      }
    });
  });
}

export function initEditAuctionTextModal() {
  const modal = document.getElementById('modalEditTextoAuction');
  const form  = document.getElementById('formTextoAuction');

  if (!modal || !form) return;

  let quill = null;
  let hiddenInput = null;

  // ---- Abrir modal
  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // Action del form
    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // Quill
    const quillWrapper = form.querySelector('.js-quill-basic');
    hiddenInput = form.querySelector('input[name="description"]');

    if (quillWrapper && quillWrapper.__quill) {
      quill = quillWrapper.__quill;

      const descriptionValue = btn.dataset.description || '';

      // Decodificar HTML
      const txt = document.createElement('textarea');
      txt.innerHTML = descriptionValue;
      const decodedHTML = txt.value;

      quill.setContents([]);
      setTimeout(() => {
        quill.clipboard.dangerouslyPasteHTML(0, decodedHTML);
      }, 1);
    }

    // Sync Quill → input hidden
    if (quill && hiddenInput) {
      quill.on('text-change', () => {
        hiddenInput.value = quill.root.innerHTML;
      });

      hiddenInput.value = quill.root.innerHTML;
    }
  });

  // ---- Cerrar modal
  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    if (quill) {
      quill.setText('');
    }

    if (hiddenInput) {
      hiddenInput.value = '';
    }
  });
}
