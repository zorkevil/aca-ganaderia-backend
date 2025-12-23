<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>Icono</th>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Categoría</th>
        <th>Servicio principal</th>
        <th>Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse($subcategories as $subcategory)
        <tr>
          <td>
            @if($subcategory->icon_url)
              <img src="{{ $subcategory->icon_url }}"
                   alt="{{ $subcategory->icon_alt }}"
                   class="img-thumbnail img-green-filter">
            @else
              <span class="text-muted">-</span>
            @endif
          </td>

          <td>{{ $subcategory->name }}</td>
          <td>{{ $subcategory->slug }}</td>

          <td>
            {{ $subcategory->category->name ?? '-' }}
          </td>

          <td>
            {{ $subcategory->category->generalCategory->name ?? '-' }}
          </td>

          <td>
            @if($subcategory->is_active)
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
              'admin.configuration.blocks.subcategory.row-actions',
              ['subcategory' => $subcategory]
            )
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay subcategorías todavía.</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
