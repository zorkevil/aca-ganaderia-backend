<?php

namespace App\Http\Requests\Admin\Configuration\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'general_category_id' => ['required', 'integer', 'exists:general_categories,id'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
