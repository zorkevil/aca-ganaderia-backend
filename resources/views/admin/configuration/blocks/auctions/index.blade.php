<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordionAuctions">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseAuctions"
                aria-expanded="true">
            Remates                
        </button>
      </h2>

      <div id="collapseAuctions"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionAuctions">

        <div class="accordion-body">

          <div class="mb-4 d-flex flex-column-reverse flex-md-row gap-3">
              <div class="d-flex align-items-start justify-content-between gap-3 flex-grow-1">
                  <div class="mb-0" id="textoAuction">
                      {!! $auctionText?->description
                          ?? '<p class="text-muted mb-0">Sin descripción cargada.</p>' !!}
                  </div>
                  @if($auctionText)
                    <button
                        type="button"
                        class="btn btn-link p-1 flex-shrink-0"
                        title="Editar"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEditTextoAuction"
                        data-id="{{ $auctionText->id }}"
                        data-description="{{ e($auctionText->description ?? '') }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                  @endif
              </div>
          </div>

          @include('admin.configuration.blocks.auctions.table', [
            'auctions' => $auctions
          ])

          <div class="mt-3 text-center">
            <button type="button"
                    class="btn btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCreateAuction">
              <i class="bi bi-plus-circle me-1"></i>
              Agregar Remate
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>


@include('admin.configuration.blocks.auctions.modal-create')
@include('admin.configuration.blocks.auctions.modal-edit')
@include('admin.configuration.blocks.auction_text.modal-edit')