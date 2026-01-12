<div class="modal fade" id="modalEditContact" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Contacto</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            id="editContactForm"
            action="{{ route('admin.configuration.contacts.update', '__ID__') }}"
            data-action-template="{{ route('admin.configuration.contacts.update', '__ID__') }}">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <input type="text" class="form-control"
                   name="name"
                   id="editNameContact"
                   placeholder="Nombre de Contacto"
                   required>
            <label for="editNameContact">Nombre de Contacto</label>
          </div>

          <div class="mb-3">
            <div class="form-floating">
              <input type="tel" class="form-control"
                     name="phone"
                     id="editPhoneContact"
                     placeholder="Teléfono"
                     required>
              <label for="editPhoneContact">Teléfono</label>
            </div>
            <div class="form-text">Formato sugerido: +54 9 11 1234-5678</div>
          </div>

          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="general_category_id"
                        class="form-select tom-select"
                        id="editGeneralCategoryContact">
                  <option value=""></option>
                  @foreach($generalCategories as $gc)
                    <option value="{{ $gc->id }}">{{ $gc->name }}</option>
                  @endforeach
                </select>
                <label for="editGeneralCategoryContact">Sección</label>
              </div>
            </div>

            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active"
                        class="form-select tom-select"
                        id="editIsActiveContact"
                        required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label for="editIsActiveContact">Estado</label>
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
