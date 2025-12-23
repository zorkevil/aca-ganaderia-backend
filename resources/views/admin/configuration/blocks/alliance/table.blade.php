<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Icono</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($alliances as $alliance)
        <tr>
          <td>
            <img src="{{ asset('storage/'.$alliance->icon_path) }}"
                 alt="{{ $alliance->alt }}"
                 class="img-thumbnail img-green-filter">
          </td>

          <td>{{ $alliance->name }}</td>

          <td>
            @if($alliance->is_active)
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
            @include('admin.configuration.blocks.alliance.row-actions', ['alliance' => $alliance])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay alianzas todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
