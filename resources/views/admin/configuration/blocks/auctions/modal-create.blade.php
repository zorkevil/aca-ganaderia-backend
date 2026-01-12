<div class="modal fade" id="modalCreateAuction" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <form method="POST"
            action="{{ route('admin.configuration.auctions.store') }}"
            enctype="multipart/form-data">
        @csrf

        {{-- Header --}}
        <div class="modal-header">
          <h2 class="modal-title text-color-3">Agregar Remate</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        {{-- Body --}}
        <div class="modal-body">          

          {{-- Título --}}
          <div class="form-floating mb-3">
            <input type="text"
                   name="title"
                   class="form-control"
                   placeholder="Título del remate"
                   required>
            <label>Título</label>
          </div>

          {{-- Imagen --}}
          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="image"
                   accept="image/jpeg,image/webp">
            <div class="form-text">Imagen JPG o WEBP (ideal 800x400px)</div>
          </div>

          {{-- ALT imagen --}}
          <div class="form-floating mb-3">
            <input type="text"
                   class="form-control"
                   name="image_alt"
                   placeholder="ALT de la imagen">
            <label>ALT de la imagen</label>
          </div>

          <div class="row">
            {{-- Modalidad --}}
            <div class="col-6 mb-3">              
              <div class="form-floating">
                <select name="auction_modality_id"
                        class="form-select tom-select"
                        required>
                  <option value=""></option>
                  @foreach ($modalities as $modality)
                    <option value="{{ $modality->id }}">
                      {{ $modality->name }}
                    </option>
                  @endforeach
                </select>
                <label>Modalidad</label>
              </div>
            </div>

            {{-- Tipo --}}
            <div class="col-6 mb-3">            
              <div class="form-floating">
                <select name="auction_type_id"
                        class="form-select tom-select"
                        required>
                  <option value=""></option>
                  @foreach ($types as $type)
                    <option value="{{ $type->id }}">
                      {{ $type->name }}
                    </option>
                  @endforeach
                </select>
                <label>Tipo de Remate</label>
              </div>  
            </div>
          </div>          

          <div class="row">
            {{-- Fecha --}}
            <div class="col-6 mb-3">    
              <div class="form-floating">
                <input type="date"
                      name="date"
                      class="form-control"
                      required>
                <label>Fecha</label>
              </div>
            </div>

            {{-- Horario --}}
            <div class="col-6 mb-3">  
              <div class="form-floating">
                <input type="text"
                      name="time"
                      class="form-control"
                      placeholder="Ej: 09:30 / 15:00"
                      required>
                <label>Horario</label>
              </div>
            </div>
          </div>         

          {{-- Descripción --}}
          <div class="form-floating mb-3">
            <textarea name="description"
                      class="form-control"
                      placeholder="Descripción"
                      style="height: 120px"></textarea>
            <label>Descripción</label>
          </div>

          {{-- Link --}}
          <div class="form-floating mb-3">
            <input type="text"
                   name="link"
                   class="form-control"
                   placeholder="Link">
            <label>Link</label>
          </div>

          {{-- Estado --}}
          <div class="form-floating mb-3">
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

        {{-- Footer --}}
        <div class="modal-footer">
          <button type="button"
                  class="btn btn-outline-primary"
                  data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit"
                  class="btn btn-primary">
            Guardar
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
