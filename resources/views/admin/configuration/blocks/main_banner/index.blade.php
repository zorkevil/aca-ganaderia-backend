<div class="accordion" id="accordionBannerPrincipal">
  <div class="accordion-item">

    <h2 class="accordion-header">
      <button class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseBannerPrincipal"
              aria-expanded="true">
        Banner principal
      </button>
    </h2>

    <div id="collapseBannerPrincipal"
         class="accordion-collapse collapse show"
         data-bs-parent="#accordionBannerPrincipal">

      <div class="accordion-body">

        @include('admin.configuration.blocks.main_banner.table', [
            'banner' => $banner
          ])

      </div>
    </div>

  </div>
</div>

@include('admin.configuration.blocks.main_banner.modal-edit')
