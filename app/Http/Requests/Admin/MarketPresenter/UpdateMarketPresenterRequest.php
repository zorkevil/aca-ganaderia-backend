<?php

namespace App\Http\Requests\Admin\MarketPresenter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketPresenterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'description' => ['nullable', 'string'],
            'alt' => ['nullable', 'string', 'max:125'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,webp', 'max:5120'],
        ];
    }
}
