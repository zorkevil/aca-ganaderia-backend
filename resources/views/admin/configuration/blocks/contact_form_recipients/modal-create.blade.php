<div class="modal fade" id="modalCreateContactFormRecipient" tabindex="-1"
     data-sections='@json($contactFormSections)'
     data-active-by-section='@json($activeRecipientsBySection)'>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Email</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            id="createContactFormRecipientForm"
            action="{{ route('admin.configuration.contact-form-recipients.store') }}">
        @csrf

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <input type="email" class="form-control"
                   name="email"
                   id="emailRecipient"
                   placeholder="Email"
                   required>
            <label for="emailRecipient">Email</label>
          </div>

          <div class="row">
            <div class="col-8 mb-3">
              <div class="form-floating">
                <select name="section"
                        class="form-select tom-select"
                        id="sectionRecipient"
                        required>
                  <option value="" selected></option>
                  @foreach($contactFormSections as $section)
                    <option value="{{ $section['id'] }}">{{ $section['name'] }}</option>
                  @endforeach
                </select>
                <label for="sectionRecipient">Sección</label>
              </div>
            </div>

            <div class="col-4 mb-3">
              <div class="form-floating">
                <select name="is_active"
                        class="form-select tom-select"
                        id="isActiveRecipient"
                        required>
                  <option value="" selected></option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label for="isActiveRecipient">Estado</label>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
