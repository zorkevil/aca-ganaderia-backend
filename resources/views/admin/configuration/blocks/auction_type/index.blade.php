<div class="d-flex flex-column gap-3">
  <div class="accordion" id="accordion2">
    <div class="accordion-item">

      <h2 class="accordion-header">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse2"
                aria-expanded="true">
            Tipos de Remate               
        </button>
      </h2>

      <div id="collapse2"
           class="accordion-collapse collapse show"
           data-bs-parent="#accordion2">

        <div class="accordion-body">

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
      @forelse ($auctionTypes as $item)
        <tr>
          <td>
            @if($item->icon_path)
              <img src="{{ asset('storage/'.$item->icon_path) }}"
                   alt="{{ $item->icon_alt }}"
                   class="img-thumbnail img-green-filter">
            @endif
          </td>

          <td>{{ $item->name }}</td>
          <td>{{ $item->slug }}</td>
          <td>{{ Str::limit($item->description, 80) }}</td>

          <td>
            @if($item->is_active)
              <span class="badge text-color-3 bg-color-4">
                <i class="bi bi-check-circle me-1"></i>Activo
              </span>
            @else
              <span class="badge bg-secondary">
                <i class="bi bi-x-circle me-1"></i>Inactivo
              </span>
            @endif
          </td>

          <td class="col-actions">
            @include('admin.configuration.blocks.auction_type.row-actions', [
              'item' => $item
            ])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted">
            No hay modalidades de remate cargados.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

</div>
      </div>

    </div>
  </div>
</div>