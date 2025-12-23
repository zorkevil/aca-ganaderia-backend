<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionSubcategories">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseSubcategories"
                aria-expanded="true">
          Subcategorías de Productos
        </button>
      </h2>

      <div id="collapseSubcategories"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionSubcategories">

        <div class="accordion-body">

          @include('admin.configuration.blocks.subcategory.table', [
            'subcategories' => $subcategories
          ])

          <div class="mt-3 text-center">
            <button type="button"
                    class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateSubcategory">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Subcategoría
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@include('admin.configuration.blocks.subcategory.modal-create')
@include('admin.configuration.blocks.subcategory.modal-edit')
