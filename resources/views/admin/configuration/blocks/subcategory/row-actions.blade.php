<button class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditSubcategory"
        data-id="{{ $subcategory->id }}"
        data-name="{{ $subcategory->name }}"
        data-slug="{{ $subcategory->slug }}"
        data-icon_alt="{{ $subcategory->icon_alt }}"
        data-is_active="{{ $subcategory->is_active ? 1 : 0 }}"
        data-category_id="{{ $subcategory->category_id }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- 
<button class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $subcategory->id }}"
        data-action="{{ route('admin.configuration.subcategories.destroy', $subcategory) }}">
  <i class="bi bi-trash"></i>
</button>
--}}