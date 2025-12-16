@foreach($sliders as $slider)
  @if($slider->image_url)
    <div class="modal fade" id="imageModal{{ $slider->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $slider->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel{{ $slider->id }}">{{ $slider->alt }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body text-center">
            <img src="{{ $slider->image_url }}" alt="{{ $slider->alt }}" class="img-fluid">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  @endif
@endforeach