<?php

namespace App\Http\Requests\Admin\AuctionType;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:120'],
            'slug'        => ['required', 'string', 'max:160', 'unique:auction_types,slug'],
            'description' => ['nullable', 'string'],
            'icon'        => ['nullable', 'file', 'mimes:svg,jpg,jpeg,png,webp', 'max:5120'],
            'icon_alt'    => ['nullable', 'string', 'max:125'],
            'is_active'   => ['required', 'boolean'],
        ];
    }
}
