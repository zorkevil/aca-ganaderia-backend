<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionGeneralCategories">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseGeneralCategories"
                aria-expanded="true">
          Servicios Principales
        </button>
      </h2>

      <div id="collapseGeneralCategories"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionGeneralCategories">

        <div class="accordion-body">

          @include('admin.configuration.blocks.general_category.table', [
            'generalCategories' => $generalCategories
          ])

          <div class="mt-3 text-center">
            <button type="button" class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateGeneralCategory">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Servicio
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>

</div>

@include('admin.configuration.blocks.general_category.modal-create')
@include('admin.configuration.blocks.general_category.modal-edit')
