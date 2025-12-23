<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Icono</th>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($auctionModalities as $auctionModality)
        <tr>
          <td>
            @if($auctionModality->icon_url)
              <img src="{{ $auctionModality->icon_url }}"
                   alt="{{ $auctionModality->icon_alt }}"
                   class="img-thumbnail img-green-filter">
            @else
              <span class="text-muted">-</span>
            @endif
          </td>

          <td>{{ $auctionModality->name }}</td>
          <td>{{ $auctionModality->slug }}</td>
          <td>{{ Str::limit($auctionModality->description, 80) }}</td>

          <td>
            @if($auctionModality->is_active)
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
            @include(
              'admin.configuration.blocks.general_category.row-actions',
              ['auctionModality' => $auctionModality]
            )
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay modalidades de remate todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
