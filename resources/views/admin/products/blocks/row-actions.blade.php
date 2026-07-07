 {{-- EDITAR --}}
@if ($product->category_id === $semillasCategoryId)

  {{-- Editar Semillas --}}
  <button
    class="btn btn-link p-1"
    data-bs-toggle="modal"
    data-bs-target="#modalEditarProductoSemillas"
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-title="{{ $product->title }}"
    data-subtitle="{{ $product->subtitle }}"
    data-slug="{{ $product->slug }}"
    data-sku="{{ $product->sku }}"
    data-description="{{ $product->description }}"
    data-image_alt="{{ $product->image_alt }}"
    data-subcategory_id="{{ $product->subcategory_id }}"
    data-date="{{ optional($product->date)->format('Y-m-d') }}"
    data-is_active="{{ $product->is_active ? 1 : 0 }}"
    data-ciclo="{{ $product->ciclo }}"
    data-aptitud_de_uso="{{ $product->aptitud_de_uso }}"
    data-contenido_de_tanino="{{ $product->contenido_de_tanino }}"
    data-calidad_de_ms="{{ $product->calidad_de_ms }}"
    data-perfil_sanitario="{{ $product->perfil_sanitario }}"
    data-altura_cm="{{ $product->altura_cm }}"
    data-despeje_de_panoja="{{ $product->despeje_de_panoja }}"
    data-bmr="{{ $product->bmr }}"
    data-porcentaje_de_panoja="{{ $product->porcentaje_de_panoja }}"
    data-zona_de_adaptacion="{{ $product->zona_de_adaptacion }}"
    data-densidad_de_siembra="{{ $product->densidad_de_siembra }}"
    data-tecnologia="{{ $product->tecnologia }}"
    data-madurez_relativa="{{ $product->madurez_relativa }}"
    data-comportamiento_a_vuelco_y_quebrado="{{ $product->comportamiento_a_vuelco_y_quebrado }}"
    data-velocidad_de_secado="{{ $product->velocidad_de_secado }}"
    data-textura_de_grano="{{ $product->textura_de_grano }}"
  >
    <i class="bi bi-pencil"></i>
  </button>

@elseif ($product->category_id === $identificacionElectronicaCategoryId)

  {{-- Editar Identificación Electrónica --}}
  <button
    class="btn btn-link p-1"
    data-bs-toggle="modal"
    data-bs-target="#modalEditarProductoIdentElectronica"
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-title="{{ $product->title }}"
    data-subtitle="{{ $product->subtitle }}"
    data-slug="{{ $product->slug }}"
    data-sku="{{ $product->sku }}"
    data-description="{{ $product->description }}"
    data-image_alt="{{ $product->image_alt }}"
    data-subcategory_id="{{ $product->subcategory_id }}"
    data-date="{{ optional($product->date)->format('Y-m-d') }}"
    data-is_active="{{ $product->is_active ? 1 : 0 }}"
  >
    <i class="bi bi-pencil"></i>
  </button>

@elseif ($product->general_category_id === $nutritionId)

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
