{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditAuctionType"
        data-id="{{ $auctionType->id }}"
        data-name="{{ $auctionType->name }}"
        data-slug="{{ $auctionType->slug }}"
        data-icon_alt="{{ $auctionType->icon_alt }}"
        data-is_active="{{ $auctionType->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>