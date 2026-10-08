<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditContactFormRecipient"
        data-id="{{ $recipient->id }}"
        data-email="{{ $recipient->email }}"
        data-section="{{ $recipient->section->value }}"
        data-is_active="{{ $recipient->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>

<button type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $recipient->id }}"
        data-action="{{ route('admin.configuration.contact-form-recipients.destroy', $recipient) }}">
  <i class="bi bi-trash"></i>
</button>
