export function initEditReportModal() {
  const modal = document.getElementById('modalEditarReport');
  const form = document.getElementById('editForm');

  if (!modal || !form) return;

  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1. URL del Form
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Campos simples (con validación de existencia)
    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value || '';
    };

    setFieldValue('editTitle', btn.dataset.title);
    setFieldValue('editLink', btn.dataset.link);
    setFieldValue('editAlt', btn.dataset.alt);
    setFieldValue('editDate', btn.dataset.date);

    // 3. Estado (TomSelect) - CON MANEJO SEGURO
    const activeSelect = document.getElementById('editActive');
    if (activeSelect) {
      const activeValue = btn.dataset.is_active !== undefined ? btn.dataset.is_active : '1';
      activeSelect.value = activeValue;
      if (activeSelect.tomselect) {
        activeSelect.tomselect.setValue(activeValue);
      }
    }

    // 4. Limpiar el campo de imagen
    const imageInput = document.getElementById('editImage');
    if (imageInput) {
      imageInput.value = '';
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    
    // Resetear TomSelect de forma segura
    const activeSelect = document.getElementById('editActive');
    if (activeSelect && activeSelect.tomselect) {
      activeSelect.tomselect.clear();
    }
  });
}

export function initEditMarketPresenterModal() {
  const modal = document.getElementById('modalEditarTextoMarketPresenter');
  const form = document.getElementById('formTextoMarketPresenter');

  if (!modal || !form) return;

  // ---- Abrir modal
  modal.addEventListener('show.bs.modal', (event) => {
    const btn = event.relatedTarget;
    if (!btn) return;

    // 1. URL del Form
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Campos simples (con validación de existencia)
    const setFieldValue = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.value = value || '';
    };
    
    setFieldValue('mpAlt', btn.dataset.alt);

    // 3. CARGA DE QUILL
    const descriptionValue = btn.dataset.description || '';
    const quillWrapper = form.querySelector('.js-quill-basic');
    
    if (quillWrapper && quillWrapper.__quill) {
      const quill = quillWrapper.__quill;
      
      // PASO A: Decodificar posibles entidades HTML (ej: &lt;strong&gt;)
      const txt = document.createElement("textarea");
      txt.innerHTML = descriptionValue;
      const decodedHTML = txt.value;

      // PASO B: Limpiar el editor e insertar
      quill.setContents([]); 
      // Usamos setTimeout para asegurar que el DOM del modal esté listo
      setTimeout(() => {
        quill.clipboard.dangerouslyPasteHTML(0, decodedHTML);
      }, 1);
    }

    // 4. Limpiar imagen
    const imageInput = document.getElementById('mpImage');
    if (imageInput) {
      imageInput.value = '';
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
