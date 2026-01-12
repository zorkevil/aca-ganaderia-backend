<?php

namespace App\Http\Requests\Admin\Configuration\Auction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuctionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        $auctionId = $this->route('auction')->id;

        return [
            'title' => ['required', 'string'],
            'link' => ['nullable', 'string'],

            'auction_modality_id' => ['required', 'exists:auction_modalities,id'],
            'auction_type_id'     => ['required', 'exists:auction_types,id'],

            'date' => ['required', 'date'],
            'time' => ['required', 'string'],

            'description' => ['nullable', 'string'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string'],

            'is_active' => ['required', 'boolean'],
        ];
    }
}
