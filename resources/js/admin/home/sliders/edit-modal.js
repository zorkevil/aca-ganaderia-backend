import Quill from 'quill';
import 'quill/dist/quill.snow.css';

const Delta = Quill.import('delta');
window.Quill = Quill;

export function initQuillBasic(context = document) {
  context.querySelectorAll('.js-quill-basic').forEach((editorEl) => {
    if (editorEl.__quill) return;

    const inputName = editorEl.dataset.inputName;
    const form = editorEl.closest('form');
    if (!inputName || !form) return;

    const inputEl = form.querySelector(`input[name="${inputName}"]`);
    if (!inputEl) return;

    const quill = new Quill(editorEl, {
      theme: 'snow',
      placeholder: editorEl.dataset.placeholder || '',
      formats: ['bold', 'italic'], 
      modules: {
        toolbar: [['bold', 'italic']],
        keyboard: {
          bindings: {
            enter: { key: 13, handler: () => false }
          }
        },
        clipboard: {
          matchers: [
            [Node.ELEMENT_NODE, (node, delta) => {
              delta.ops = delta.ops.map(op => {
                if (typeof op.insert === 'string') {
                  return { insert: op.insert.replace(/\n/g, ' ') };
                }
                return op;
              });
              return delta;
            }]
          ]
        }
      },
    });

    // Carga inicial
    if (inputEl.value) {
      quill.clipboard.dangerouslyPasteHTML(inputEl.value);
    }

    form.addEventListener('submit', () => {
      let html = quill.root.innerHTML;
      if (html === '<p><br></p>') {
        html = '';
      } else {
        html = html.replace(/^<p>/, '').replace(/<\/p>$/, '');
      }
      inputEl.value = html;
    });

    editorEl.__quill = quill;
  });
}

export default function initEditSliderModal() {
  const modal = document.getElementById('modalEditarSlider');
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

    setFieldValue('editAlt', btn.dataset.alt);
    setFieldValue('editLink', btn.dataset.link);
    setFieldValue('editOrder', btn.dataset.sort_order);

    // 3. CARGA CRÍTICA DE QUILL
    const textValue = btn.dataset.text || '';
    const quillWrapper = form.querySelector('.js-quill-basic');
    
    if (quillWrapper && quillWrapper.__quill) {
      const quill = quillWrapper.__quill;
      
      // PASO A: Decodificar posibles entidades HTML (ej: &lt;strong&gt;)
      const txt = document.createElement("textarea");
      txt.innerHTML = textValue;
      const decodedHTML = txt.value;

      // PASO B: Limpiar el editor e insertar
      quill.setContents([]); 
      // Usamos setTimeout para asegurar que el DOM del modal esté listo
      setTimeout(() => {
        quill.clipboard.dangerouslyPasteHTML(0, decodedHTML);
      }, 1);
    }

    // 4. Estado (TomSelect)
    const activeSelect = document.getElementById('editActive');
    if (activeSelect) {
      const activeValue = btn.dataset.is_active !== undefined ? btn.dataset.is_active : '1';
      activeSelect.value = activeValue;
      if (activeSelect.tomselect) {
        activeSelect.tomselect.setValue(activeValue);
      }
    }
  });

  modal.addEventListener('hidden.bs.modal', () => {
    form.reset();
    const quillWrapper = form.querySelector('.js-quill-basic');
    if (quillWrapper && quillWrapper.__quill) {
      quillWrapper.__quill.setContents([]);
    }
  });
}