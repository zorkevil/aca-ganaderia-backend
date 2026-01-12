{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditNutritionService" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title">Editar Servicio</h2>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            id="editNutritionServiceForm"
            action="{{ route('admin.sections.services.update', [$section, '__ID__']) }}"
            data-action-template="{{ route('admin.sections.services.update', [$section, '__ID__']) }}"
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="form-floating mb-3">
            <input class="form-control"
                   name="title"
                   id="editNutritionServiceTitle"
                   placeholder="Título"
                   required>
            <label>Título</label>
          </div>

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   id="editNutritionServiceIcon"
                   accept="image/svg+xml,image/png,image/jpeg,image/webp">
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
            <div class="form-text">Si subís una nueva imagen, reemplaza la anterior</div>
          </div>

          <div class="form-floating mb-3">
            <input class="form-control"
                   name="icon_alt"
                   id="editNutritionServiceIconAlt"
                   placeholder="ALT del icono">
            <label>ALT del icono</label>
          </div>

          <div class="form-floating">
            <select name="is_active"
                    id="editNutritionServiceIsActive"
                    class="form-select tom-select"
                    required>
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
            Guardar cambios
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
