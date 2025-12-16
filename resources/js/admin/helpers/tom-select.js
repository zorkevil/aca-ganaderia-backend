import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.bootstrap5.css';

window.TomSelect = TomSelect;

export function initTomSelect(context = document) {
  context.querySelectorAll('.tom-select').forEach((selectElement) => {
    if (selectElement.tomselect) return;

    const config = {
      allowEmptyOption: true,
      controlInput: null,
      render: {
        item(data, escape) {
          return '<div>' + escape(data.text) + '</div>';
        },
        option(data, escape) {
          if (data.value === '') {
            return '<div style="display:none;"></div>';
          }
          return '<div>' + escape(data.text) + '</div>';
        }
      }
    };

    const tomSelectInstance = new TomSelect(selectElement, config);

    const formFloating = selectElement.closest('.form-floating');
    if (formFloating) {
      setTimeout(() => {
        const updateLabelState = (value) => {
          if (!value) {
            formFloating.classList.add('no-value');
          } else {
            formFloating.classList.remove('no-value');
          }
        };

        updateLabelState(tomSelectInstance.getValue());
        tomSelectInstance.on('change', updateLabelState);
      }, 100);
    }
  });
}
