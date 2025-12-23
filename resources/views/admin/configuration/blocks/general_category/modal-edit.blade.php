{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditGeneralCategory" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Servicio Principal</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            id="editGeneralCategoryForm"
            action="{{ route('admin.configuration.general-categories.update', '__ID__') }}"
            data-action-template="{{ route('admin.configuration.general-categories.update', '__ID__') }}"
            enctype="multipart/form-data"
            novalidate>
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="name"
                   id="editNameGeneralCategories"
                   placeholder="Nombre"
                   required>
            <label for="editNameGeneralCategories">Nombre</label>
          </div>

          <div class="mb-3 form-floating">
            <textarea class="form-control"
                      name="description"
                      id="editDescriptionGeneralCategories"
                      style="min-height: 100px !important;"
                      required></textarea>
            <label for="editDescriptionGeneralCategories">Descripción</label>
          </div>

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   id="editIconGeneralCategories"
                   accept="image/svg+xml,image/jpeg,image/png,image/webp">
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
            <div class="form-text">Si subís una nueva imagen, reemplaza la anterior</div>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="icon_alt"
                   id="editIconAltGeneralCategories"
                   placeholder="ALT"
                   maxlength="125"
                   required>
            <label for="editIconAltGeneralCategories">ALT de la imagen</label>
          </div>

          <div class="row">

            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text"
                       class="form-control"
                       name="slug"
                       id="editSlugGeneralCategories"
                       placeholder="Slug"
                       required>
                <label for="editSlugGeneralCategories">Slug</label>
              </div>
            </div>

            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active"
                        class="form-select tom-select"
                        id="editIsActiveGeneralCategories"
                        required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label>Estado</label>
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