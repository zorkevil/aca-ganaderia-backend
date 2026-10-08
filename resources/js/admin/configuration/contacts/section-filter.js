// Lee del modal las secciones y el contacto activo de cada una
export function readSectionData(modal) {
  const parse = (value, fallback) => {
    try {
      return JSON.parse(value) ?? fallback;
    } catch {
      return fallback;
    }
  };

  return {
    sections: parse(modal.dataset.sections, []),
    activeBySection: parse(modal.dataset.activeBySection, {}),
  };
}

// Si el estado es "Activo", solo deja las secciones sin contacto activo
// (o cuyo contacto activo es el que se está editando)
export function filterSectionOptions(select, { sections, activeBySection }, { onlyAvailable, contactId = null }) {
  const ts = select?.tomselect;
  if (!ts) return;

  const current = ts.getValue();

  const allowed = sections.filter((section) => {
    if (!onlyAvailable) return true;
    const active = activeBySection[section.id];
    return !active || String(active.id) === String(contactId);
  });

  ts.clear(true);
  ts.clearOptions();
  allowed.forEach((section) => ts.addOption({ value: String(section.id), text: section.name }));
  ts.refreshOptions(false);

  if (current && allowed.some((section) => String(section.id) === String(current))) {
    ts.setValue(current, true);
  } else {
    // dispara 'clear' para que el label flotante vuelva a su lugar
    ts.clear();
  }
}
