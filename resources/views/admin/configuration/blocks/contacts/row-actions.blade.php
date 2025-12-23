<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditContact"
        data-id="{{ $contact->id }}"
        data-name="{{ $contact->name }}"
        data-phone="{{ $contact->phone }}"
        data-general_category_id="{{ $contact->general_category_id }}"
        data-is_active="{{ $contact->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>

<button type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $contact->id }}"
        data-action="{{ route('admin.configuration.contacts.destroy', $contact) }}">
  <i class="bi bi-trash"></i>
</button>
