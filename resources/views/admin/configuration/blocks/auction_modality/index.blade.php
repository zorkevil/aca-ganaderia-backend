<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionAuctionModalities">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseAuctionModalities"
                aria-expanded="true">
            Modalidades de Remate               
        </button>
      </h2>

      <div id="collapseAuctionModalities"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionAuctionModalities">

        <div class="accordion-body">

          @include('admin.configuration.blocks.auction_modality.table', [
            'auctionModalities' => $auctionModalities
          ])

          <div class="mt-3 text-center">
            <button type="button" class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateAuctionModality">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Modalidad de Remate
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

@include('admin.configuration.blocks.auction_modality.modal-create')
@include('admin.configuration.blocks.auction_modality.modal-edit')