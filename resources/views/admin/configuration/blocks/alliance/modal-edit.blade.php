<div class="modal fade" id="modalEditAlliance" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form id="formEditAlliance"
            method="POST"
            action=""
            data-action-template="{{ route('admin.configuration.alliances.update', '__ID__') }}"
            enctype="multipart/form-data"
            novalidate>
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h2 class="modal-title text-color-3">Editar Alianza</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- Icon -->
          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   accept="image/svg+xml,image/jpeg,image/png,image/webp">               
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
            <div class="form-text">Si subís una nueva imagen, reemplaza la anterior</div>
          </div>

          <!-- Nombre -->
          <div class="mb-3 form-floating">
            <input type="text"
                   name="name"
                   id="editAllianceName"
                   class="form-control"
                   placeholder="Nombre"
                   required>
            <label>Nombre</label>
          </div>

          <!-- ALT -->
          <div class="form-floating mb-3">
            <input type="text"
                   name="alt"
                   id="editAllianceAlt"
                   class="form-control"
                   placeholder="ALT del icono"
                   required>
            <label>ALT del icono</label>
          </div>

          <!-- Estado -->
          <div class="mb-3 form-floating">
            <select name="is_active"
                    id="editAllianceIsActive"
                    class="form-select tom-select"
                    required>
              <option value=""></option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <label>Estado</label>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button"
                  class="btn btn-outline-primary"
                  data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
