{{-- MODAL EDITAR BANNER PRINCIPAL --}}
<div class="modal fade" id="modalEditMainBanner" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Banner Principal</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST"
            id="editMainBannerForm"
            action="{{ route('admin.sections.main-banner.update', '__SECTION__') }}"
            data-action-template="{{ route('admin.sections.main-banner.update', '__SECTION__') }}"
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3">
            <input type="file"
                   class="form-control"
                   name="image"
                   accept="image/jpeg,image/png,image/webp">
            <div class="form-text">Imagen JPG o WEBP (ideal 3840x2160px)</div>
            <div class="form-text">Si subís una nueva, reemplaza la anterior al actualizar</div>
          </div>

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="image_alt"
                   id="editMainBannerAlt"
                   maxlength="125"
                   required>
            <label>ALT de la imagen</label>
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
