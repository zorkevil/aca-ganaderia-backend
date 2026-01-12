<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($auctionTypes as $auctionType)
        <tr>
          <td>{{ $auctionType->name }}</td>
          <td>{{ $auctionType->slug }}</td>

          <td>
            @if($auctionType->is_active)
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
              'admin.configuration.blocks.auction_type.row-actions',
              ['auctionType' => $auctionType]
            )
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay tipos de remate todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
