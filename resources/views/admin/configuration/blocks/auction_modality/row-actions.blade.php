{{-- EDITAR --}}
<button type="button"
        class="btn btn-link p-1"
        title="Editar"
        data-bs-toggle="modal"
        data-bs-target="#modalEditAuctionModality"
        data-id="{{ $auctionModality->id }}"
        data-name="{{ $auctionModality->name }}"
        data-slug="{{ $auctionModality->slug }}"
        data-icon_alt="{{ $auctionModality->icon_alt }}"
        data-is_active="{{ $auctionModality->is_active ? 1 : 0 }}">
  <i class="bi bi-pencil"></i>
</button>