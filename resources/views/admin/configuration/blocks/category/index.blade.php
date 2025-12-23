<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionCategories">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseCategories"
                aria-expanded="true">
          Categorías de Productos
        </button>
      </h2>

      <div id="collapseCategories"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionCategories">

        <div class="accordion-body">

          @include('admin.configuration.blocks.category.table', [
            'categories' => $categories
          ])

          <div class="mt-3 text-center">
            <button type="button"
                    class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateCategory">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Categoría
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@include('admin.configuration.blocks.category.modal-create')
@include('admin.configuration.blocks.category.modal-edit')
