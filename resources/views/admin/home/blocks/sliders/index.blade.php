<div class="d-flex flex-column gap-3">

  <div class="accordion" id="accordionSlider">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseSlider"
                aria-expanded="true">
          Slider principal
        </button>
      </h2>

      <div id="collapseSlider"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionSlider">

        <div class="accordion-body">

          @include('admin.home.blocks.sliders.table', ['sliders' => $sliders])

          <div class="mt-3 text-center">
            <button type="button" class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAgregarSlider">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Slider
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>

</div>

@include('admin.home.blocks.sliders.modal-create')
@include('admin.home.blocks.sliders.modal-edit')
