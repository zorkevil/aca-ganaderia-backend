<div class="modal fade" id="modalProductoSanidad" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Producto – Sanidad</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data"
            novalidate>
        @csrf

        <input type="hidden" name="general_category_id" value="{{ $sanidadId }}">

        <div class="modal-body">

          <div class="row">
            <div class="col-4 mb-3 form-floating">
              <input type="text" name="name" class="form-control" required>
              <label>Nombre comercial</label>
            </div>

            <div class="col-4 mb-3 form-floating">
              <input type="text" name="sku" class="form-control" required>
              <label>SKU</label>
            </div>

            <div class="col-4 mb-3 form-floating">
              <input type="text" name="slug" class="form-control" required>
              <label>Slug</label>
            </div>
          </div>

          <div class="mb-3 form-floating">
            <textarea name="description" class="form-control" style="height: 90px"></textarea>
            <label>Descripción</label>
          </div>

          <div class="row">
            <div class="col-4 mb-3 form-floating">
              <select name="category_id" class="form-select tom-select" required>
                <option value=""></option>
                @foreach($categoriesSanidad as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              <label>Categoría</label>
            </div>

            <div class="col-4 mb-3 form-floating">
              <select name="subcategory_id" class="form-select tom-select">
                <option value=""></option>
              </select>
              <label>Subcategoría</label>
            </div>

            <div class="col-4 mb-3 form-floating">
              <input type="text" name="senasa" class="form-control">
              <label>N° SENASA</label>
            </div>
          </div>

          <div class="row">
            <div class="col-6 mb-3 form-floating">
              <textarea name="formula" class="form-control"></textarea>
              <label>Fórmula</label>
            </div>

            <div class="col-6 mb-3 form-floating">
              <textarea name="dosage" class="form-control"></textarea>
              <label>Dosis</label>
            </div>
          </div>

          <div class="row">
            <div class="col-6 mb-3 form-floating">
              <textarea name="administration" class="form-control"></textarea>
              <label>Administración</label>
            </div>

            <div class="col-6 mb-3 form-floating">
              <input type="text" name="presentation" class="form-control">
              <label>Presentación</label>
            </div>
          </div>

          <div class="row">
            <div class="col-6 mb-3">
              <input type="file" name="image" class="form-control">
              <div class="form-text">Imagen JPG o WEBP</div>
            </div>

            <div class="col-6 mb-3 form-floating">
              <input type="date" name="date" class="form-control" required>
              <label>Fecha</label>
            </div>
          </div>

          <div class="form-floating">
            <select name="is_active" class="form-select" required>
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