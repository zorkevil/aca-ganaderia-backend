<button
  type="button"
  class="btn btn-link p-1 js-edit-alliance"
  data-id="{{ $alliance->id }}"
  data-name="{{ $alliance->name }}"
  data-alt="{{ $alliance->alt }}"
  data-active="{{ $alliance->is_active }}"
  data-bs-toggle="modal"
  data-bs-target="#modalEditAlliance"
>
  <i class="bi bi-pencil"></i>
</button>

<button class="btn btn-link p-1 text-danger"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $alliance->id }}"
        data-action="{{ route('admin.configuration.alliances.destroy', $alliance) }}">
  <i class="bi bi-trash"></i>
</button>