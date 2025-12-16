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
      formats: ['bold', 'italic'], // Solo permitimos estos formatos
      modules: {
        toolbar: [['bold', 'italic']],
        keyboard: {
          bindings: {
            enter: { key: 13, handler: () => false } // Bloquea saltos de línea
          }
        },
        clipboard: {
          matchers: [
            [Node.ELEMENT_NODE, (node, delta) => {
              // Al pegar, mantenemos BOLD e ITALIC pero quitamos el resto
              delta.ops = delta.ops.map(op => {
                if (typeof op.insert === 'string') {
                  // Mantenemos los atributos si son bold o italic, pero limpiamos saltos de línea
                  const newOp = { insert: op.insert.replace(/\n/g, ' ') };
                  if (op.attributes) {
                    newOp.attributes = {};
                    if (op.attributes.bold) newOp.attributes.bold = true;
                    if (op.attributes.italic) newOp.attributes.italic = true;
                  }
                  return newOp;
                }
                return op;
              });
              return delta;
            }]
          ]
        }
      },
    });

    // Carga inicial desde el input hidden
    if (inputEl.value) {
      quill.clipboard.dangerouslyPasteHTML(inputEl.value);
    }

    form.addEventListener('submit', () => {
      let html = quill.root.innerHTML;
      if (html === '<p><br></p>') {
        html = '';
      } else {
        // Limpiamos los párrafos pero mantenemos el contenido interno (tags bold/italic)
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

    // 1. Action del Form
    const id = btn.dataset.id;
    const tpl = form.dataset.actionTemplate;
    if (id && tpl) {
      form.action = tpl.replace('__ID__', id);
    }

    // 2. Llenado de campos simples
    const fields = {
      'editAlt': btn.dataset.alt,
      'editLink': btn.dataset.link,
      'editOrder': btn.dataset.sort_order
    };

    Object.keys(fields).forEach(fieldId => {
      const el = document.getElementById(fieldId);
      if (el) el.value = fields[fieldId] || '';
    });

    // 3. CARGA DE QUILL (Solución al texto plano)
    const rawHTML = btn.dataset.text || '';
    const quillWrapper = form.querySelector('.js-quill-basic');
    
    if (quillWrapper && quillWrapper.__quill) {
      const quill = quillWrapper.__quill;
      
      // Creamos un div temporal para decodificar entidades HTML si vienen del data-attribute
      const txt = document.createElement("div");
      txt.innerHTML = rawHTML;
      const cleanHTML = txt.textContent || txt.innerText; 
      
      // IMPORTANTE: Si cleanHTML contiene etiquetas como <strong>, 
      // Quill las interpretará correctamente aquí.
      quill.setContents([]); 
      
      // Usamos el contenido directamente. Si el botón tiene <strong>, dangerouslyPasteHTML lo verá.
      quill.clipboard.dangerouslyPasteHTML(0, rawHTML);
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
}