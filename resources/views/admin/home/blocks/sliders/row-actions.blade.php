{{-- BOTÓN EDITAR --}}
<button class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditarSlider"
        data-id="{{ $slider->id }}"
        data-text="{{ e($slider->text) }}"
        data-alt="{{ e($slider->alt) }}"
        data-link="{{ e($slider->link ?? '') }}"
        data-sort_order="{{ $slider->sort_order }}"
        data-is_active="{{ $slider->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>

{{-- ELIMINAR --}}
<button
        type="button"
        class="btn btn-link p-1 text-danger"
        title="Eliminar"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $slider->id }}"
        data-action="{{ route('admin.home.sliders.destroy', $slider) }}">
  <i class="bi bi-trash"></i>
</button>
