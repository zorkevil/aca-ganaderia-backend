<div class="modal fade" id="modalCreateAlliance" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form method="POST"
            action="{{ route('admin.configuration.alliances.store') }}"
            enctype="multipart/form-data" novalidate>
        @csrf

        <div class="modal-header">
          <h2 class="modal-title text-color-3">Agregar Alianza</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   accept="image/svg+xml,image/jpeg,image/png,image/webp"     
                   required>
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 210x150px)</div>
          </div>

          <div class="mb-3 form-floating">
            <input type="text" name="name" class="form-control" placeholder="Nombre" required>
            <label>Nombre</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="alt" placeholder="ALT del icono" required>
            <label>ALT del icono</label>
          </div>

          {{--  
          <div class="form-floating mb-3">
            <input type="url" class="form-control" name="link" placeholder="Link (opcional)">
            <label>Link (opcional)</label>
          </div>
          --}}

          <div class="mb-3 form-floating">
            <select name="is_active"
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
          <button type="button" class="btn btn-outline-primary"data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
