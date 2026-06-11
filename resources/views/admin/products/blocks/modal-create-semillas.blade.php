<div class="modal fade" id="modalProductoSemillas" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Agregar Producto – Semillas</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="general_category_id" value="{{ $sanidadId }}">
          <input type="hidden" name="category_id" value="{{ $semillasCategoryId }}">

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
            <select id="createSemillasSubcategory" name="subcategory_id" class="form-select tom-select">
              <option value=""></option>
              @foreach($subcategoriesSemillas as $subcategory)
                @php
                  $slug = $subcategory->slug;
                  $group = str_contains($slug, 'granifero') ? 'sorgo-granifero'
                         : (str_contains($slug, 'forrajero') ? 'sorgo-forrajero'
                         : (str_contains($slug, 'maiz-doble-proposito') ? 'maiz-doble-proposito' : ''));
                @endphp
                <option value="{{ $subcategory->id }}" data-group="{{ $group }}">{{ $subcategory->name }}</option>
              @endforeach
            </select>
            <label>Subcategoría</label>
          </div>

          {{-- Campos dinámicos --}}
          <div id="createSemillasFields">

            {{-- SORGO GRANÍFERO --}}
            <div data-semillas-group="sorgo-granifero" style="display:none">
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="aptitud_de_uso" class="form-control" placeholder="Aptitud de uso">
                    <label>Aptitud de uso</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="ciclo" class="form-control" placeholder="Ciclo">
                    <label>Ciclo</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="contenido_de_tanino" class="form-control" placeholder="Contenido de tanino">
                    <label>Contenido de tanino</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="altura_cm" class="form-control" placeholder="Altura cm">
                    <label>Altura cm</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="despeje_de_panoja" class="form-control" placeholder="Despeje de panoja">
                    <label>Despeje de panoja</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="calidad_de_ms" class="form-control" placeholder="Calidad de MS">
                    <label>Calidad de MS</label>
                  </div>
                </div>
              </div>
              <div class="mb-3 form-floating">
                <textarea name="perfil_sanitario" class="form-control" style="min-height:100px" placeholder="Perfil sanitario"></textarea>
                <label>Perfil sanitario</label>
              </div>
            </div>

            {{-- SORGO FORRAJERO --}}
            <div data-semillas-group="sorgo-forrajero" style="display:none">
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="ciclo" class="form-control" placeholder="Ciclo">
                    <label>Ciclo</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="bmr" class="form-control" placeholder="BMR">
                    <label>BMR</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="contenido_de_tanino" class="form-control" placeholder="Contenido de tanino">
                    <label>Contenido de tanino</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="aptitud_de_uso" class="form-control" placeholder="Aptitud de uso">
                    <label>Aptitud de uso</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="porcentaje_de_panoja" class="form-control" placeholder="Porcentaje de panoja">
                    <label>Porcentaje de panoja</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="calidad_de_ms" class="form-control" placeholder="Calidad de MS">
                    <label>Calidad de MS</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="zona_de_adaptacion" class="form-control" placeholder="Zona de adaptación">
                    <label>Zona de adaptación</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="densidad_de_siembra" class="form-control" placeholder="Densidad de siembra">
                    <label>Densidad de siembra</label>
                  </div>
                </div>
              </div>
              <div class="mb-3 form-floating">
                <textarea name="perfil_sanitario" class="form-control" style="min-height:100px" placeholder="Perfil sanitario"></textarea>
                <label>Perfil sanitario</label>
              </div>
            </div>

            {{-- MAÍZ DOBLE PROPÓSITO --}}
            <div data-semillas-group="maiz-doble-proposito" style="display:none">
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="tecnologia" class="form-control" placeholder="Tecnología">
                    <label>Tecnología</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="madurez_relativa" class="form-control" placeholder="Madurez relativa">
                    <label>Madurez relativa</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="ciclo" class="form-control" placeholder="Ciclo">
                    <label>Ciclo</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="comportamiento_a_vuelco_y_quebrado" class="form-control" placeholder="Comportamiento a vuelco y quebrado">
                    <label>Comportamiento a vuelco y quebrado</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="velocidad_de_secado" class="form-control" placeholder="Velocidad de secado">
                    <label>Velocidad de secado</label>
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <div class="form-floating">
                    <input type="text" name="textura_de_grano" class="form-control" placeholder="Textura de grano">
                    <label>Textura de grano</label>
                  </div>
                </div>
              </div>
            </div>

          </div>{{-- /createSemillasFields --}}

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
