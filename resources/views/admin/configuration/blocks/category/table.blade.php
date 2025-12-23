<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Icono</th>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Servicio principal</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($categories as $category)
        <tr>
          <td>
            @if($category->icon_url)
              <img src="{{ $category->icon_url }}"
                   alt="{{ $category->icon_alt }}"
                   class="img-thumbnail img-green-filter">
            @else
              <span class="text-muted">-</span>
            @endif
          </td>

          <td>{{ $category->name }}</td>
          <td>{{ $category->slug }}</td>

          <td>
            {{ $category->generalCategory->name ?? '-' }}
          </td>

          <td>
            @if($category->is_active)
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
              'admin.configuration.blocks.category.row-actions',
              ['category' => $category]
            )
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay categorías todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
