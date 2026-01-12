{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalCreateAuctionModality" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <form method="POST"
            action="{{ route('admin.configuration.auction-modalities.store') }}"
            enctype="multipart/form-data">
        @csrf

        <div class="modal-header">
          <h2 class="modal-title text-color-3">Agregar Modalidad de Remate</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">          
          <div class="mb-3 form-floating">
            <input type="text" class="form-control" name="name" id="nameAuctionModalities" placeholder="Nombre" required>
            <label for="nameAuctionModalities">Nombre</label>
          </div>

          <div class="row"> 
            <div class="col-6 mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" name="slug" id="slugAuctionModalities" placeholder="Slug" required>
                <label for="slugAuctionModalities">Slug</label>
              </div>
            </div>

            <div class="col-6 mb-3">
                <div class="form-floating">
                    <select name="is_active" class="form-select tom-select" required>
                        <option value="" selected></option>
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
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
