import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.bootstrap5.css';

window.TomSelect = TomSelect;

export function initTomSelect(context = document) {
  context.querySelectorAll('.tom-select').forEach((selectElement) => {
    if (selectElement.tomselect) return;

    const config = {
      allowEmptyOption: false, // Cambiado a false para evitar problemas
      placeholder: selectElement.dataset.placeholder || '', // Permite placeholder desde data-attribute
      controlInput: null,
      render: {
        item(data, escape) {
          return '<div>' + escape(data.text) + '</div>';
        },
        option(data, escape) {
          return '<div>' + escape(data.text) + '</div>';
        }
      }
    };

    const tomSelectInstance = new TomSelect(selectElement, config);

    // Manejo de form-floating
    const formFloating = selectElement.closest('.form-floating');
    if (formFloating) {
      setTimeout(() => {
        const updateLabelState = (value) => {
          if (!value || value === '') {
            formFloating.classList.add('no-value');
          } else {
            formFloating.classList.remove('no-value');
          }
        };

        // Estado inicial
        updateLabelState(tomSelectInstance.getValue());
        
        // Actualizar en cambios
        tomSelectInstance.on('change', updateLabelState);
        
        // Actualizar cuando se limpia el select
        tomSelectInstance.on('clear', () => {
          formFloating.classList.add('no-value');
        });
      }, 100);
    }
  });
}