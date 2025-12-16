<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title text-color-3">
          ¿Estás seguro que querés eliminar este item?
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p class="mb-0">
          Una vez eliminado, no podrás recuperarlo. <strong>Esta acción no se puede deshacer.</strong>
        </p>
      </div>

      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-outline-primary"
          data-bs-dismiss="modal"
        >
          Cancelar
        </button>

        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">
            Eliminar
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
