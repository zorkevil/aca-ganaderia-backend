<div class="d-flex flex-column gap-3">

  <div class="accordion" id="accordionMarketPresenter">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseMarketPresenter"
                aria-expanded="true">
          Presentación de Informes
        </button>
      </h2>

      <div id="collapseMarketPresenter"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordionMarketPresenter">

        <div class="accordion-body">
            <div class="mb-4 d-flex flex-column-reverse flex-md-row gap-3">
                <div class="">
                  @if($marketPresenter->image_path)
                      <img src="{{ $marketPresenter->image_url }}" alt="{{ $marketPresenter->alt }}" style="max-height: 150px;">
                  @endif
                </div>
                <div class="d-flex align-items-start justify-content-between gap-3 flex-grow-1">
                    <div class="mb-0" id="textoMarketPresenter">
                        {!! $marketPresenter?->description
                            ?? '<p class="text-muted mb-0">Sin descripción cargada.</p>' !!}
                    </div>
                     @if($marketPresenter)
                        <button
                            type="button"
                            class="btn btn-link p-1 flex-shrink-0"
                            title="Editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarTextoMarketPresenter"
                            data-id="{{ $marketPresenter->id }}"
                            data-description="{{ e($marketPresenter->description ?? '') }}"
                            data-alt="{{ $marketPresenter->alt ?? '' }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
      </div>

    </div>
  </div>

</div>

@include('admin.reports.blocks.market_presenter.modal-edit')
