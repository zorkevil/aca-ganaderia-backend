 {{-- EDITAR --}}
@if ($product->general_category_id === $nutritionId)

  {{-- Editar Nutrición --}}
  <button
    class="btn btn-link p-1"
    data-bs-toggle="modal"
    data-bs-target="#modalEditProductoNutricion"
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-title="{{ $product->title }}"
    data-subtitle="{{ $product->subtitle }}"
    data-slug="{{ $product->slug }}"
    data-sku="{{ $product->sku }}"
    data-description="{{ $product->description }}"
    data-presentation="{{ $product->presentation }}"
    data-administration="{{ $product->administration }}"
    data-second_category="{{ $product->second_category }}"
    data-dosage="{{ $product->dosage }}"
    data-category_id="{{ $product->category_id }}"
    data-date="{{ optional($product->date)->format('Y-m-d') }}"
    data-is_active="{{ $product->is_active }}"
    data-image_alt="{{ $product->image_alt }}"
  >
    <i class="bi bi-pencil"></i>
  </button>

@elseif ($product->general_category_id === $sanidadId)

  {{-- Editar Sanidad --}}
  <button
    class="btn btn-link p-1"
    data-bs-toggle="modal"
    data-bs-target="#modalEditarProductoSanidad"
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-title="{{ $product->title }}"
    data-subtitle="{{ $product->subtitle }}"
    data-slug="{{ $product->slug }}"
    data-sku="{{ $product->sku }}"
    data-description="{{ $product->description }}"
    data-senasa="{{ $product->senasa }}"
    data-presentation="{{ $product->presentation }}"
    data-administration="{{ $product->administration }}"
    data-formula="{{ $product->formula }}"
    data-dosage="{{ $product->dosage }}"
    data-image_alt="{{ $product->image_alt }}"
    data-category_id="{{ $product->category_id }}"
    data-subcategory_id="{{ $product->subcategory_id }}"
    data-date="{{ optional($product->date)->format('Y-m-d') }}"
    data-is_active="{{ $product->is_active ? 1 : 0 }}"
    data-especie_animal="{{ $product->especie_animal }}"
  >
    <i class="bi bi-pencil"></i>
  </button>

@endif

{{-- ELIMINAR --}}
<button class="btn btn-link p-1 text-danger"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $product->id }}"
        data-action="{{ route('admin.products.destroy', $product) }}">
  <i class="bi bi-trash"></i>
</button>
