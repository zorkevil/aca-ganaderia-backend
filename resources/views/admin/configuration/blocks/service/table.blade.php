<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Título</th>
        <th>Icono</th>
        <th>ALT del icono</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($services as $service)
        <tr>
          <td>{{ $service->title }}</td>
          <td>
            @if($service->icon_url)
              <img src="{{ $service->icon_url }}"
                    alt="{{ $service->icon_alt }}"
                    class="img-thumbnail img-green-filter">
            @endif
          </td>
          <td>{{ Str::limit($service->icon_alt, 40) }}</td>

          <td>
            @if($service->is_active)
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
            @include('admin.configuration.blocks.service.row-actions', ['service' => $service])
          </td>
        </tr>      
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay servicios todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>