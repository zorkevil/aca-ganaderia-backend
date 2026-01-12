<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionAuctionTypes">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseAuctionTypes"
                aria-expanded="true">
            Tipos de Remate               
        </button>
      </h2>

      <div id="collapseAuctionTypes"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionAuctionTypes">

        <div class="accordion-body">

          @include('admin.configuration.blocks.auction_type.table', [
            'auctionTypes' => $auctionTypes
          ])

          <div class="mt-3 text-center">
            <button type="button" class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateAuctionType">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Tipo de Remate
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

@include('admin.configuration.blocks.auction_type.modal-create')
@include('admin.configuration.blocks.auction_type.modal-edit')