{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalCreateNutritionService" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Agregar Servicio</h2>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST"
            action="{{ route('admin.sections.services.store', $section) }}"
            enctype="multipart/form-data" novalidate>
        @csrf

        <input type="hidden" name="section" value="nutricion">     

        <div class="modal-body">
          <div class="form-floating mb-3">
            <input class="form-control" name="title" placeholder="Título" required>
            <label>Título</label>
          </div>

          <div class="mb-3">
            <input type="file" class="form-control"
                  name="icon"
                  accept="image/svg+xml,image/png,image/jpeg,image/webp">
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>       
          </div>

          <div class="mb-3 form-floating">
            <input class="form-control" name="icon_alt" placeholder="ALT del icono">
            <label>ALT del icono</label>
          </div>

          <div class="mb-3 form-floating">
              <select name="is_active" class="form-select tom-select" required>
                  <option value="" selected></option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
              </select>
              <label>Estado</label>
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