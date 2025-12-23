<div class="modal fade" id="modalCreateAuctionModality" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <form method="POST"
            action="{{ route('admin.configuration.auction-modalities.store') }}"
            enctype="multipart/form-data">
        @csrf

        <div class="modal-header">
          <h2 class="modal-title text-color-3">Agregar Modalidad de remate</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
