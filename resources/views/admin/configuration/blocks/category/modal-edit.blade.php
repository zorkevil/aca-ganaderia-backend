{{-- MODAL EDITAR CATEGORY --}}
<div class="modal fade" id="modalEditCategory" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Categoría</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            id="editCategoryForm"
            action="{{ route('admin.configuration.categories.update', '__ID__') }}"
            data-action-template="{{ route('admin.configuration.categories.update', '__ID__') }}"
            enctype="multipart/form-data"
            novalidate>
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <select name="general_category_id"
                    id="editCategoryGeneralCategory"
                    class="form-select tom-select"
                    required>
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
                   id="editCategoryName"
                   required>
            <label>Nombre</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="slug"
                   id="editCategorySlug"
                   required>
            <label>Slug</label>
          </div>

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="icon"
                   accept="image/svg+xml,image/jpeg,image/png,image/webp">            
            <div class="form-text">Imagen SVG, JPG, PNG o WEBP (ideal 150x150px)</div>
            <div class="form-text">Si subís una nueva imagen, reemplaza la anterior</div>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="icon_alt"
                   id="editCategoryIconAlt"
                   required>
            <label>ALT del icono</label>
          </div>

          <div class="mb-3 form-floating">
            <select name="is_active"
                    id="editCategoryActive"
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
