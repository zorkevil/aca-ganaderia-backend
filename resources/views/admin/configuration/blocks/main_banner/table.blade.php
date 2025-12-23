<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th scope="col">Imagen</th>
        <th scope="col">ALT de la imagen</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          @if($banner?->image_url)
            <img src="{{ $banner->image_url }}"
                  alt="{{ $banner->image_alt }}"
                  class="img-thumbnail"
                  style="min-height: 70px; object-fit: cover; cursor: pointer;"
                  loading="lazy"
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal{{ $banner->id }}">
          @else
            <span class="text-muted">Sin banner</span>
          @endif
        </td>

        <td>{{ Str::limit($banner->image_alt, 40) }}</td>

        <td class="col-actions">
            @include(
            'admin.configuration.blocks.main_banner.row-actions',
            ['banner' => $banner]
            )
        </td>
      </tr>    
    </tbody>
  </table>
</div>

{{-- Modales de imágenes --}}
@include('admin.configuration.blocks.main_banner.image-modals', ['banner' => $banner])