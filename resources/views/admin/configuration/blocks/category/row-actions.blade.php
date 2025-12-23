<button class="btn btn-link p-1"
        data-bs-toggle="modal"
        data-bs-target="#modalEditCategory"
        data-id="{{ $category->id }}"
        data-name="{{ $category->name }}"
        data-slug="{{ $category->slug }}"
        data-icon_alt="{{ $category->icon_alt }}"
        data-is_active="{{ $category->is_active ? 1 : 0 }}"
        data-general_category_id="{{ $category->general_category_id }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- 
<button class="btn btn-link p-1 text-danger"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $category->id }}"
        data-action="{{ route('admin.configuration.categories.destroy', $category) }}">
  <i class="bi bi-trash"></i>
</button>
--}}