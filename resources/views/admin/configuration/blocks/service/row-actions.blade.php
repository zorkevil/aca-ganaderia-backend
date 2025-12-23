{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditNutritionService"
        data-id="{{ $service->id }}"
        data-title="{{ $service->title }}"
        data-icon_alt="{{ $service->icon_alt }}"
        data-is_active="{{ $service->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- ELIMINAR --}}
<button
        type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $service->id }}"
        data-action="{{ route('admin.sections.services.destroy', [$section, $service]) }}">
  <i class="bi bi-trash"></i>
</button>