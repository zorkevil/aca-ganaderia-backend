// Prefijos de IDs usados en el modal de edición por grupo
const EDIT_FIELD_IDS = {
  'sorgo-granifero': {
    aptitud_de_uso:    'editSemillasGran_aptitud_de_uso',
    ciclo:             'editSemillasGran_ciclo',
    contenido_de_tanino: 'editSemillasGran_contenido_de_tanino',
    altura_cm:         'editSemillasGran_altura_cm',
    despeje_de_panoja: 'editSemillasGran_despeje_de_panoja',
    calidad_de_ms:     'editSemillasGran_calidad_de_ms',
    perfil_sanitario:  'editSemillasGran_perfil_sanitario',
  },
  'sorgo-forrajero': {
    ciclo:              'editSemillasForr_ciclo',
    bmr:                'editSemillasForr_bmr',
    contenido_de_tanino:'editSemillasForr_contenido_de_tanino',
    aptitud_de_uso:     'editSemillasForr_aptitud_de_uso',
    porcentaje_de_panoja:'editSemillasForr_porcentaje_de_panoja',
    calidad_de_ms:      'editSemillasForr_calidad_de_ms',
    zona_de_adaptacion: 'editSemillasForr_zona_de_adaptacion',
    densidad_de_siembra:'editSemillasForr_densidad_de_siembra',
    perfil_sanitario:   'editSemillasForr_perfil_sanitario',
  },
  'maiz-doble-proposito': {
    tecnologia:         'editSemillasMaiz_tecnologia',
    madurez_relativa:   'editSemillasMaiz_madurez_relativa',
    ciclo:              'editSemillasMaiz_ciclo',
    comportamiento_a_vuelco_y_quebrado: 'editSemillasMaiz_comportamiento_a_vuelco_y_quebrado',
    velocidad_de_secado:'editSemillasMaiz_velocidad_de_secado',
    textura_de_grano:   'editSemillasMaiz_textura_de_grano',
  },
};

function getGroupFromSelect(selectEl, value) {
  if (!value) return null;
  const option = selectEl.querySelector(`option[value="${value}"]`);
  return option?.dataset.group || null;
}

// Muestra el grupo activo y deshabilita los inputs de grupos inactivos
// para que no se envíen en el form (evita conflictos de name duplicado).
function applyGroup(fieldsContainerId, group, clear = false) {
  const container = document.getElementById(fieldsContainerId);
  if (!container) return;

  container.querySelectorAll('[data-semillas-group]').forEach(section => {
    const active = section.dataset.semillasGroup === group;
    section.style.display = active ? '' : 'none';
    section.querySelectorAll('input, textarea').forEach(el => {
      if (active) {
        el.disabled = false;
      } else {
        el.disabled = true;
        if (clear) el.value = '';
      }
    });
  });
}

export function hookSemillasSubcategory(selectId, fieldsContainerId) {
  const select = document.getElementById(selectId);
  if (!select) return;

  const onChange = (value) => {
    const group = getGroupFromSelect(select, value);
    applyGroup(fieldsContainerId, group, true);
  };

  if (select.tomselect) {
    select.tomselect.on('change', onChange);
  } else {
    select.addEventListener('change', () => onChange(select.value));
  }
}

export function populateSemillasEditFields(group, data) {
  if (!group || !EDIT_FIELD_IDS[group]) return;

  Object.entries(EDIT_FIELD_IDS[group]).forEach(([field, elId]) => {
    const el = document.getElementById(elId);
    if (el) el.value = data[field] ?? '';
  });
}

export { getGroupFromSelect, applyGroup };
