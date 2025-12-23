{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalCreateGeneralCategory" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Servicio Principal</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            action="{{ route('admin.configuration.general-categories.store') }}"
            enctype="multipart/form-data" novalidate>
        @csrf

        <div class="modal-body">
          <div class="mb-3 form-floating">
            <input type="text" class="form-control" name="name" id="nameGeneralCategories" placeholder="Nombre" required>
            <label for="nameGeneralCategories">Nombre</label>
          </div>

          <div class="mb-3 form-floating">
            <textarea class="form-control" name="description" id="descriptionGeneralCategories" style="min-height: 100px !important;" required></textarea>
            <label for="descriptionGeneralCategories">Descripción</label>
          </div>

          <div class="mb-3">
              <input type="file" class="form-control" name="icon" id="iconGeneralCategories" accept="image/svg+xml,image/jpeg,image/png,image/webp">
              <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
          </div>

          <div class="mb-3 form-floating">
              <input type="text" class="form-control" name="icon_alt" id="iconAltGeneralCategories" placeholder="ALT" maxlength="125" required>
              <label for="iconAltGeneralCategories">ALT de la imagen</label>
          </div>

          <div class="row"> 

            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" name="slug" id="slugGeneralCategories" placeholder="Slug" required>
                <label for="slugGeneralCategories">Slug</label>
              </div>
            </div>

            <div class="col-6 mb-3">
                <div class="form-floating">
                    <select name="is_active" class="form-select tom-select" required>
                        <option value="" selected></option>
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
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
