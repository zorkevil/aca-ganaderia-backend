<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Imagen</th>
        <th>Título</th>
        <th>Tipo</th>
        <th>Modalidad</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($auctions as $auction)
        <tr>          
          <td>{{ \Carbon\Carbon::parse($auction->date)->format('d/m/Y') }}</td>
          <td>
            @if($auction->image_url)
              <img src="{{ $auction->image_url }}"
                  alt="{{ $auction->image_alt }}"
                  class="img-thumbnail"
                  style="object-fit: cover; cursor: pointer;"
                  loading="lazy"
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal{{ $auction->id }}">
            @else
              <span class="text-muted">Sin imagen</span>
            @endif
          </td>          

          <td>{{ Str::limit($auction->title, 50) }}</td>

          <td>
            {{ $auction->modality->name ?? '-' }}
          </td>
          <td>
            {{ $auction->type->name ?? '-' }}
          </td>

          <td>
            @if($auction->is_active)
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
            @include('admin.configuration.blocks.auctions.row-actions', ['auction' => $auction])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay remates todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
