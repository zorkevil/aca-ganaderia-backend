{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditMainBanner"
        data-section="{{ $section }}"
        data-image_alt="{{ $banner?->image_alt }}">
  <i class="bi bi-pencil"></i>
</button>