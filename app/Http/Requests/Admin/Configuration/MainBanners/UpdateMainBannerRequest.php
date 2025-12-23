<?php

namespace App\Http\Requests\Admin\Configuration\MainBanners;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
        ];
    }
}
