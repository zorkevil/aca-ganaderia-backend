@if($banner->getImageUrlAttribute())
  <div class="modal fade" id="imageModal{{ $banner->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $banner->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel{{ $banner->id }}">{{ $banner->image_alt }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body text-center">
          <img src="{{ $banner->getImageUrlAttribute() }}" alt="{{ $banner->image_alt }}" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endif