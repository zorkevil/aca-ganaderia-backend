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

          <td class="col-actions">
            @include('admin.products.blocks.row-actions', ['product' => $product])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            <p class="mb-0">No hay productos todavía.</p>
          </td>
        </tr>
      @endforelse

    </tbody>
  </table>
</div>

<div class="mt-3">
  {{ $products->links() }}
</div>
