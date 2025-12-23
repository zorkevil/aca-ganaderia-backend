export function initEditAllianceModal() {
  const modal = document.getElementById('modalEditAlliance');
  const form  = document.getElementById('formEditAlliance');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // Action
    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    const set = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value ?? '';
    };

    // Campos básicos
    set('editAllianceName', btn.dataset.name);
    set('editAllianceAlt', btn.dataset.alt);

    // Preview imagen
    const preview = document.getElementById('editAlliancePreview');
    if (preview && btn.dataset.image) {
      preview.src = btn.dataset.image;
    }

    // Estado (tom-select)
    const active = document.getElementById('editAllianceIsActive');
    if (active) {
      active.value = btn.dataset.active;
      if (active.tomselect) {
        active.tomselect.setValue(btn.dataset.active);
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();

    // Limpiar tom-select
    const active = document.getElementById('editAllianceIsActive');
    if (active?.tomselect) {
      active.tomselect.clear();
    }

    // Limpiar preview
    const preview = document.getElementById('editAlliancePreview');
    if (preview) {
      preview.src = '';
    }
  });
}

export function initEditAllianceTextModal() {
  const modal = document.getElementById('modalEditTextoAlliance');
  const form  = document.getElementById('formTextoAlliance');

  if (!modal || !form) return;

  let quill = null;
  let hiddenInput = null;

  // ---- Abrir modal
  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1. URL del form (por consistencia con otros modales)
    const id  = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;

    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Quill
    const quillWrapper = form.querySelector('.js-quill-basic');
    hiddenInput = form.querySelector('input[name="description"]');

    if (quillWrapper && quillWrapper.__quill) {
      quill = quillWrapper.__quill;

      const descriptionValue = btn.dataset.description || '';

      // A. Decodificar entidades HTML
      const txt = document.createElement('textarea');
      txt.innerHTML = descriptionValue;
      const decodedHTML = txt.value;

      // B. Limpiar e insertar HTML
      quill.setContents([]);
      setTimeout(() => {
        quill.clipboard.dangerouslyPasteHTML(0, decodedHTML);
      }, 1);
    }

    // 3. Sync Quill → hidden input (al editar)
    if (quill && hiddenInput) {
      quill.on('text-change', () => {
        hiddenInput.value = quill.root.innerHTML;
      });

      // Set inicial
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
