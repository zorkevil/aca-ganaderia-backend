<div class="modal fade" id="modalEditProductoNutricion" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Producto – Nutrición</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>


      <div class="modal-body">
        <form id="formEditProductoNutricion"
              method="POST"
              action=""
              enctype="multipart/form-data"
              data-action-template="{{ route('admin.products.update', '__ID__') }}"
              novalidate>
          @csrf
          @method('PUT')

            {{-- Nombre comercial --}}
            <div class="mb-3 form-floating">
              <input type="text" name="name" id="editName" class="form-control" required>
              <label>Nombre comercial</label>
            </div>

            {{-- Título / Subtítulo --}}
            <div class="row">
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <input type="text" name="title" id="editTitle" class="form-control">
                  <label>Título</label>
                </div>
              </div>
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <input type="text" name="subtitle" id="editSubtitle" class="form-control">
                  <label>Subtítulo</label>
                </div>
              </div>
            </div>

            {{-- Slug / SKU --}}
            <div class="row">
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <input type="text" name="slug" id="editSlug" class="form-control" required>
                  <label>Slug</label>
                </div>
              </div>
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <input type="text" name="sku" id="editSku" class="form-control" required>
                  <label>SKU</label>
                </div>
              </div>
            </div>

            {{-- Descripción --}}
            <div class="mb-3 form-floating">
              <textarea name="description" id="editDescription" class="form-control" style="min-height: 100px !important;"></textarea>
              <label>Descripción</label>
            </div>

            {{-- Imagen --}}
            <div class="mb-3">
              <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
              <div class="form-text">Imagen JPG, PNG o WEBP (ideal 1440x1440px)</div>
              <div class="form-text">Si cargás una nueva imagen, reemplaza la anterior</div>
            </div>

            {{-- ALT --}}
            <div class="mb-3 form-floating">
              <input type="text" name="image_alt" id="editImageAlt" class="form-control">
              <label>ALT de la imagen</label>
            </div>

            {{-- Presentación / Administración --}}
            <div class="row">
              <div class="col-6 mb-3">    
                <div class="form-floating">
                  <textarea name="presentation" id="editPresentation" class="form-control" style="min-height: 100px !important;"></textarea>
                  <label>Presentación</label>
                </div>
              </div>
              <div class="col-6 mb-3 form-floating">
                <div class="form-floating">
                  <textarea name="administration" id="editAdministration" class="form-control" style="min-height: 100px !important;"></textarea>
                  <label>Administración</label>
                </div>
              </div>
            </div>

            {{-- Second category / Dosificación --}}
            <div class="row">
              <div class="col-6 mb-3">                
                <div class="form-floating">
                  <textarea name="second_category" id="editSecondCategory" class="form-control" style="min-height: 100px !important;"></textarea>
                  <label>Categoría</label>
                </div>
              </div>
              <div class="col-6 mb-3">            
                <div class="form-floating">
                  <textarea name="dosage" id="editDosage" class="form-control" style="min-height: 100px !important;"></textarea>
                  <label>Dosificación</label>
                </div>
              </div>
            </div>

            {{-- Categoría / Fecha --}}
            <div class="row">
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <select name="category_id" id="editCategory" class="form-select tom-select" required>
                    <option value=""></option>
                    @foreach($categoriesNutrition as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  <label>Categoría</label>
                </div>
              </div>
              <div class="col-6 mb-3">
                <div class="form-floating">
                  <input type="date" name="date" id="editDate" class="form-control" required>
                  <label>Fecha</label>
                </div>
              </div>
            </div>

            {{-- Estado --}}
            <div class="mb-3 form-floating">
              <select name="is_active" id="editIsActive" class="form-select tom-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
              <label>Estado</label>
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
