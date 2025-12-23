<div class="modal fade" id="modalEditarProductoSanidad" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Producto – Sanidad</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form
          id="formEditarProductoSanidad"
          method="POST"
          action=""
          enctype="multipart/form-data"
          data-action-template="{{ route('admin.products.update', '__ID__') }}"
          novalidate
        >
          @csrf
          @method('PUT')

          <input type="hidden" name="general_category_id" value="{{ $sanidadId }}">

          {{-- Nombre comercial --}}
          <div class="mb-3">
            <div class="form-floating">
              <input type="text" name="name" id="editSanidadName" class="form-control" placeholder="Nombre comercial" required>
              <label>Nombre comercial</label>
            </div>
          </div>

          {{-- Título / Subtítulo --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="title" id="editSanidadTitle" class="form-control" placeholder="Título">
                <label>Título</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="subtitle" id="editSanidadSubtitle" class="form-control" placeholder="Subtítulo">
                <label>Subtítulo</label>
              </div>
            </div>
          </div>

          {{-- Slug / SKU --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="slug" id="editSanidadSlug" class="form-control" placeholder="Slug" required>
                <label>Slug</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" name="sku" id="editSanidadSku" class="form-control" placeholder="SKU" required>
                <label>SKU</label>
              </div>
            </div>
          </div>

          {{-- Descripción --}}
          <div class="mb-3">
            <div class="form-floating">
              <textarea name="description" id="editSanidadDescription" class="form-control" style="min-height:100px" placeholder="Descripción"></textarea>
              <label>Descripción</label>
            </div>
          </div>

          {{-- SENASA --}}
          <div class="mb-3">
            <div class="form-floating">
              <input type="text" name="senasa" id="editSanidadSenasa" class="form-control" placeholder="Registro SENASA">
              <label>Registro SENASA</label>
            </div>
          </div>

          {{-- Imagen --}}
          <div class="mb-3">
            <input type="file" name="image" class="form-control">
            <div class="form-text">Solo subir si se desea reemplazar</div>
          </div>

          {{-- ALT imagen --}}
          <div class="mb-3">
            <div class="form-floating">
              <input type="text" name="image_alt" id="editSanidadImageAlt" class="form-control" placeholder="ALT de la imagen">
              <label>ALT de la imagen</label>
            </div>
          </div>

          {{-- Presentación / Administración --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="presentation" id="editSanidadPresentation" class="form-control" style="min-height:100px" placeholder="Presentación"></textarea>
                <label>Presentación</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="administration" id="editSanidadAdministration" class="form-control" style="min-height:100px" placeholder="Administración"></textarea>
                <label>Administración</label>
              </div>
            </div>
          </div>

          {{-- Fórmula / Dosificación --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="formula" id="editSanidadFormula" class="form-control" style="min-height:100px" placeholder="Fórmula"></textarea>
                <label>Fórmula</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="dosage" id="editSanidadDosage" class="form-control" style="min-height:100px" placeholder="Dosificación"></textarea>
                <label>Dosificación</label>
              </div>
            </div>
          </div>

          {{-- Categoría / Subcategoría --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="category_id" id="editSanidadCategory" class="form-select tom-select">
                  <option value=""></option>
                  @foreach($categoriesSanidad as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <label>Categoría</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="subcategory_id" id="editSanidadSubcategory" class="form-select tom-select">
                  <option value=""></option>
                  @foreach($subcategoriesSanidad as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                  @endforeach
                </select>
                <label>Subcategoría</label>
              </div>
            </div>
          </div>

          {{-- Fecha / Estado --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="date" name="date" id="editSanidadDate" class="form-control">
                <label>Fecha</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active" id="editSanidadIsActive" class="form-select tom-select">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label>Estado</label>
              </div>
            </div>
          </div>

          {{-- Especies --}}
          <div class="mb-3">
            <label class="form-label fw-semibold">Selección de especie/s</label>
            <div class="row">
              @foreach(['aves','porcinos','felinos','conejos','bovinos','equinos','roedores','camelidos','ovinos','caninos','caprinos'] as $especie)
                <div class="col-4">
                  <div class="form-check">
                    <input
                      class="form-check-input especie-check"
                      type="checkbox"
                      name="especie_animal[]"
                      value="{{ $especie }}"
                      id="editSanidadEspecie_{{ $especie }}"
                    >
                    <label class="form-check-label" for="editSanidadEspecie_{{ $especie }}">
                      {{ ucfirst($especie) }}
                    </label>
                  </div>
                </div>
              @endforeach
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
