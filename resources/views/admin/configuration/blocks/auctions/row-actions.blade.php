<button
  type="button"
  class="btn btn-link p-1 js-edit-auction"
  data-id="{{ $auction->id }}"
  data-link="{{ $auction->link }}"
  data-date="{{ optional($auction->date)->format('Y-m-d') }}"
  data-time="{{ $auction->time }}"
  data-name="{{ $auction->title }}"
  data-description="{{ $auction->description }}"
  data-alt="{{ $auction->image_alt }}"
  data-active="{{ $auction->is_active }}"
  data-type_id="{{ $auction->auction_type_id }}"
  data-auction_modality_id="{{ $auction->auction_modality_id }}"
  data-bs-toggle="modal"
  data-bs-target="#modalEditarAuction"
>
  <i class="bi bi-pencil"></i>
</button>

<button class="btn btn-link p-1 text-danger"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminar"
        data-id="{{ $auction->id }}"
        data-action="{{ route('admin.configuration.auctions.destroy', $auction) }}">
  <i class="bi bi-trash"></i>
</button>