{{-- MODAL EDITAR --}}
<div class="modal fade" id="modalEditAuctionModality" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">Editar Modalidad de Remate</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form method="POST"
            id="editAuctionModalityForm"
            action="{{ route('admin.configuration.auction-modalities.update', '__ID__') }}"
            data-action-template="{{ route('admin.configuration.auction-modalities.update', '__ID__') }}"
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3 form-floating">
            <input type="text"
                   class="form-control"
                   name="name"
                   id="editNameAuctionModalities"
                   placeholder="Nombre"
                   required>
            <label for="editNameAuctionModalities">Nombre</label>
          </div>

          <div class="row">

            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text"
                       class="form-control"
                       name="slug"
                       id="editSlugAuctionModalities"
                       placeholder="Slug"
                       required>
                <label for="editSlugAuctionModalities">Slug</label>
              </div>
            </div>

            <div class="col-6 mb-3">
              <div class="form-floating">
                <select name="is_active"
                        class="form-select tom-select"
                        id="editIsActiveAuctionModalities"
                        required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <label>Estado</label>
              </div>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>
    </div>
  </div>
</div>