<div class="modal fade" id="modalEditarProductoIdentElectronica" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Producto – Identificación Electrónica</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form
          id="formEditarProductoIdentElectronica"
          method="POST"
          action=""
          enctype="multipart/form-data"
          data-action-template="{{ route('admin.products.update', '__ID__') }}">
          @csrf
          @method('PUT')

          <input type="hidden" name="general_category_id" value="{{ $sanidadId }}">
          <input type="hidden" name="category_id" value="{{ $identificacionElectronicaCategoryId }}">

          {{-- Nombre comercial --}}
          <div class="mb-3">
            <div class="form-floating">
              <input type="text" name="name" id="editIdentElectronicaName" class="form-control" placeholder="Nombre comercial" required>
              <label>Nombre comercial</label>
            </div>
          </div>

          {{-- Título / Subtítulo --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="title" id="editIdentElectronicaTitle" class="form-control" placeholder="Título">
                <label>Título</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="subtitle" id="editIdentElectronicaSubtitle" class="form-control" placeholder="Subtítulo">
                <label>Subtítulo</label>
              </div>
            </div>
          </div>

          {{-- Slug / SKU --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="slug" id="editIdentElectronicaSlug" class="form-control" placeholder="Slug" required>
                <label>Slug</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="sku" id="editIdentElectronicaSku" class="form-control" placeholder="SKU" required>
                <label>SKU</label>
              </div>
            </div>
          </div>

          {{-- Descripción --}}
          <div class="mb-3">
            <div class="form-floating">
              <textarea name="description" id="editIdentElectronicaDescription" class="form-control" style="min-height:100px" placeholder="Descripción" required></textarea>
              <label>Descripción</label>
            </div>
          </div>

          {{-- Imagen --}}
          <div class="mb-3">
            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <div class="form-text">Solo subir si se desea reemplazar</div>
          </div>

          {{-- ALT imagen --}}
          <div class="mb-3">
            <div class="form-floating">
              <input type="text" name="image_alt" id="editIdentElectronicaImageAlt" class="form-control" placeholder="ALT de la imagen" required>
              <label>ALT de la imagen</label>
            </div>
          </div>

          {{-- Subcategoría --}}
          <div class="mb-3 form-floating">
            <select name="subcategory_id" id="editIdentElectronicaSubcategory" class="form-select tom-select">
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
                <input type="date" name="date" id="editIdentElectronicaDate" class="form-control" required>
                <label>Fecha</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active" id="editIdentElectronicaIsActive" class="form-select tom-select">
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
              Guardar cambios
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
