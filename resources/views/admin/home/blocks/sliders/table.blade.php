<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th scope="col">N° de orden</th>
        <th scope="col">Imagen</th>
        <th scope="col">Texto</th>
        <th scope="col">ALT de la imagen</th>
        <th scope="col">Estado</th>
        <th scope="col" class="col-actions">Acciones</th>
      </tr>
    </thead>
    <tbody>

      @forelse($sliders as $slider)
        <tr>
          <td>{{ $slider->sort_order }}</td>

          <td>
            @if($slider->image_url)
              <img src="{{ $slider->image_url }}"
                  alt="{{ $slider->alt }}"
                  class="img-thumbnail"
                  style="width: 64px; height: 64px; object-fit: cover; cursor: pointer;"
                  loading="lazy"
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal{{ $slider->id }}">
            @else
              <span class="text-muted">Sin imagen</span>
            @endif
          </td>

          <td>{!! Str::words($slider->text, 10, '...') ?? '-' !!}</td>
          <td>{{ Str::limit($slider->alt, 40) }}</td>

          <td>
            @if($slider->is_active)
              <span class="badge text-color-3 bg-color-4">
                <i class="bi bi-check-circle me-1"></i>Activo
              </span>
            @else
              <span class="badge text-color-1 bg-color-18">
                <i class="bi bi-x-circle me-1"></i>Inactivo
              </span>
            @endif
          </td>

          <td class="col-actions">
            @include('admin.home.blocks.sliders.row-actions', ['slider' => $slider])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay sliders todavía.</p>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-primary mt-2">
              <i class="bi bi-plus-circle me-1"></i>Crear primer slider
            </a>
          </td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>

{{-- Modales de imágenes --}}
@include('admin.home.blocks.sliders.image-modals', ['sliders' => $sliders])