<div class="modal fade" id="modalProductoIdentElectronica" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Producto – Identificación Electrónica</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="general_category_id" value="{{ $identificacionElectronicaGeneralCategoryId }}">
          <input type="hidden" name="category_id" value="{{ $identificacionElectronicaCategoryId }}">

          {{-- Nombre comercial --}}
          <div class="mb-3 form-floating">
            <input type="text" name="name" class="form-control" placeholder="Nombre comercial" required>
            <label>Nombre comercial</label>
          </div>

          {{-- Título / Subtítulo --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="title" class="form-control" placeholder="Título">
                <label>Título</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="subtitle" class="form-control" placeholder="Subtítulo">
                <label>Subtítulo</label>
              </div>
            </div>
          </div>

          {{-- Slug / SKU --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="slug" class="form-control" placeholder="Slug" required>
                <label>Slug</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="sku" class="form-control" placeholder="SKU" required>
                <label>SKU</label>
              </div>
            </div>
          </div>

          {{-- Descripción --}}
          <div class="mb-3 form-floating">
            <textarea name="description" class="form-control" style="min-height: 100px" required></textarea>
            <label>Descripción</label>
          </div>

          {{-- Imagen --}}
          <div class="mb-3">
            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <div class="form-text">Imagen JPG, PNG o WEBP (ideal 1440x1440px)</div>
          </div>

          {{-- ALT imagen --}}
          <div class="mb-3 form-floating">
            <input type="text" name="image_alt" class="form-control" placeholder="ALT de la imagen" required>
            <label>ALT de la imagen</label>
          </div>

          {{-- Subcategoría --}}
          <div class="mb-3 form-floating">
            <select name="subcategory_id" class="form-select tom-select">
              <option value=""></option>
              @foreach($subcategoriesIdentElectronica as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
              @endforeach
            </select>
            <label>Subcategoría</label>
          </div>

          {{-- Fecha / Estado --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="date" name="date" class="form-control" required>
                <label>Fecha</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active" class="form-select tom-select" required>
                  <option value=""></option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label>Estado</label>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
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
</div>
