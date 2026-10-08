<div class="modal fade" id="modalEditContactFormRecipient" tabindex="-1"
     data-sections='@json($contactFormSections)'
     data-active-by-section='@json($activeRecipientsBySection)'>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Email</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            id="editContactFormRecipientForm"
            action="{{ route('admin.configuration.contact-form-recipients.update', '__ID__') }}"
            data-action-template="{{ route('admin.configuration.contact-form-recipients.update', '__ID__') }}">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="alert alert-info d-none" id="editContactFormRecipientActiveWarning" role="alert">
            <i class="bi bi-info-circle me-1"></i>
            Para activar este email, primero desactivá
            <strong data-active-name></strong>, que es el email activo de esta sección.
          </div>

          <div class="mb-3 form-floating">
            <input type="email" class="form-control"
                   name="email"
                   id="editEmailRecipient"
                   placeholder="Email"
                   required>
            <label for="editEmailRecipient">Email</label>
          </div>

          <div class="row">
            <div class="col-8 mb-3">
              <div class="form-floating">
                <select name="section"
                        class="form-select tom-select"
                        id="editSectionRecipient"
                        required>
                  <option value=""></option>
                  @foreach($contactFormSections as $section)
                    <option value="{{ $section['id'] }}">{{ $section['name'] }}</option>
                  @endforeach
                </select>
                <label for="editSectionRecipient">Sección</label>
              </div>
            </div>

            <div class="col-4 mb-3">
              <div class="form-floating">
                <select name="is_active"
                        class="form-select tom-select"
                        id="editIsActiveRecipient"
                        required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label for="editIsActiveRecipient">Estado</label>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>
    </div>
  </div>
</div>
