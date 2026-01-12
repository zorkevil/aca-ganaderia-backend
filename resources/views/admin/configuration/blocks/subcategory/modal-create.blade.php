{{-- MODAL AGREGAR SUBCATEGORY --}}
<div class="modal fade" id="modalCreateSubcategory" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Subcategoría</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            action="{{ route('admin.configuration.subcategories.store') }}"
            enctype="multipart/form-data">
        @csrf

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <select name="category_id"
                    class="form-select tom-select"
                    required>
              <option value=""></option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">
                  {{ $category->generalCategory->name }} — {{ $category->name }}
                </option>
              @endforeach
            </select>
            <label>Categoría</label>
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
                   maxlength="125"
                   placeholder="ALT del icono"
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
