<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th scope="col">Imagen</th>
        <th scope="col">Nombre comercial</th>
        <th scope="col">Línea</th>
        <th scope="col">Categoría</th>
        <th scope="col">Subcategoría</th>
        <th scope="col">SKU</th>
        <th scope="col">Estado</th>
        <th class="col-actions">Acciones</th>
      </tr>
    </thead>
    <tbody>

      @forelse($products as $product)
        <tr>
          <td>
            @if($product->image_url)
              <img src="{{ $product->image_url }}"
                  alt="{{ $product->image_alt }}"
                  class="img-thumbnail"
                  style="object-fit: cover; cursor: pointer;"
                  loading="lazy"
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal{{ $product->id }}">
            @else
              <span class="text-muted">Sin imagen</span>
            @endif
          </td>

          <td>{{ $product->name }}</td>

          <td>{{ $product->generalCategory->name ?? '-' }}</td>

          <td>{{ $product->category->name ?? '-' }}</td>

          <td>{{ $product->subcategory->name ?? '-' }}</td>

          <td>{{ $product->sku }}</td>          

          <td>
            @if($product->is_active)
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
            @include('admin.products.blocks.row-actions', ['product' => $product])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay productos todavía.</p>
          </td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>

{{-- Links de paginación --}}
<div class="mt-3">
    {{ $products->links('vendor.pagination.bootstrap') }}
</div>
