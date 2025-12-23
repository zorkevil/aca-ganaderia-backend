{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditAuctionModality"
        data-id="{{ $item->id }}"
        data-name="{{ $item->name }}"
        data-slug="{{ $item->slug }}"
        data-description="{{ $item->description }}"
        data-icon_alt="{{ $item->icon_alt }}"
        data-is_active="{{ $item->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>