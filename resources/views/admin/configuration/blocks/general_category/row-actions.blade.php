{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditGeneralCategory"
        data-id="{{ $generalCategory->id }}"
        data-name="{{ $generalCategory->name }}"
        data-slug="{{ $generalCategory->slug }}"
        data-description="{{ $generalCategory->description }}"
        data-icon_alt="{{ $generalCategory->icon_alt }}"
        data-is_active="{{ $generalCategory->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- ELIMINAR --}}
{{-- 
<button
        type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $generalCategory->id }}"
        data-action="{{ route('admin.configuration.general-categories.destroy', $generalCategory) }}">
  <i class="bi bi-trash"></i>
</button>
--}}