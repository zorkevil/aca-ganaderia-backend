<div class="modal fade" id="modalProductoSanidad" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Producto – Sanidad</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data"
              novalidate>
          @csrf

          <input type="hidden" name="general_category_id" value="{{ $sanidadId }}">

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
            <textarea name="description" class="form-control" style="min-height: 100px"></textarea>
            <label>Descripción</label>
          </div>

          {{-- SENASA --}}
          <div class="mb-3 form-floating">
            <input type="text" name="senasa" class="form-control" placeholder="Registro SENASA">
            <label>Registro SENASA</label>
          </div>

          {{-- Imagen --}}
          <div class="mb-3">
            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
            <div class="form-text">Imagen JPG, PNG o WEBP (ideal 1440x1440px)</div>
          </div>

          {{-- ALT imagen --}}
          <div class="mb-3 form-floating">
            <input type="text" name="image_alt" class="form-control" placeholder="ALT de la imagen">
            <label>ALT de la imagen</label>
          </div>

          {{-- Presentación / Administración --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="presentation" class="form-control" style="min-height: 100px"></textarea>
                <label>Presentación</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="administration" class="form-control" style="min-height: 100px"></textarea>
                <label>Administración</label>
              </div>
            </div>
          </div>

          {{-- Fórmula / Dosificación --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="formula" class="form-control" style="min-height: 100px"></textarea>
                <label>Fórmula</label>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="form-floating">
                <textarea name="dosage" class="form-control" style="min-height: 100px"></textarea>
                <label>Dosificación</label>
              </div>
            </div>
          </div>

          {{-- Categoría / Subcategoría --}}
          <div class="row">
            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="category_id" class="form-select tom-select" required>
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
                <select name="subcategory_id" class="form-select tom-select">
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

          {{-- Especies --}}
          <div class="mb-3">
            <label class="form-label fw-semibold">Selección de especie/s</label>

            <div class="row">
              <div class="col-4">
                @foreach(['aves','porcinos','felinos','conejos'] as $especie)
                  <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="especie_animal[]"
                           value="{{ $especie }}"
                           id="especie_{{ $especie }}">
                    <label class="form-check-label" for="especie_{{ $especie }}">
                      {{ ucfirst($especie) }}
                    </label>
                  </div>
                @endforeach
              </div>

              <div class="col-4">
                @foreach(['bovinos','equinos','roedores','camelidos'] as $especie)
                  <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="especie_animal[]"
                           value="{{ $especie }}"
                           id="especie_{{ $especie }}">
                    <label class="form-check-label" for="especie_{{ $especie }}">
                      {{ ucfirst($especie) }}
                    </label>
                  </div>
                @endforeach
              </div>

              <div class="col-4">
                @foreach(['ovinos','caninos','caprinos'] as $especie)
                  <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="especie_animal[]"
                           value="{{ $especie }}"
                           id="especie_{{ $especie }}">
                    <label class="form-check-label" for="especie_{{ $especie }}">
                      {{ ucfirst($especie) }}
                    </label>
                  </div>
                @endforeach
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
