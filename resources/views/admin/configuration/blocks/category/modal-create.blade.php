{{-- MODAL AGREGAR CATEGORY --}}
<div class="modal fade" id="modalCreateCategory" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Categoría</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            action="{{ route('admin.configuration.categories.store') }}"
            enctype="multipart/form-data"
            novalidate>
        @csrf

        <div class="modal-body">

          {{-- General Category --}}
          <div class="mb-3 form-floating">
            <select name="general_category_id"
                    class="form-select tom-select"
                    required>
              <option value=""></option>
              @foreach($generalCategories as $generalCategory)
                <option value="{{ $generalCategory->id }}">
                  {{ $generalCategory->name }}
                </option>
              @endforeach
            </select>
            <label>Servicio principal</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="name"
                   placeholder="Nombre"
                   required>
            <label>Nombre</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="slug"
                   placeholder="Slug"
                   required>
            <label>Slug</label>
          </div>

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   accept="image/svg+xml,image/jpeg,image/png,image/webp">             
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="icon_alt"
                   placeholder="ALT del icono"
                   maxlength="125"
                   required>
            <label>ALT del icono</label>
          </div>

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
