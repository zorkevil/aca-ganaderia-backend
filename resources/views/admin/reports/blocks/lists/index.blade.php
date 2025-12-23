<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionReport">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseReport"
                aria-expanded="true">
          Listado de Informes
        </button>
      </h2>

      <div id="collapseReport"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionReport">

        <div class="accordion-body">

          @include('admin.reports.blocks.lists.table', ['reports' => $reports])

          <div class="mt-3 text-center">
            <button type="button" class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAgregarReport">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Informe
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>

</div>

@include('admin.reports.blocks.lists.modal-create')
@include('admin.reports.blocks.lists.modal-edit')
