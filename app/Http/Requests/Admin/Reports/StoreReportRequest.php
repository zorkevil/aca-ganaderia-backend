<?php

namespace App\Http\Requests\Admin\Reports;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'alt' => ['required','string','max:125'],
            'link' => ['required', 'string', 'max:2048'],
            'date' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
            'image' => ['nullable','image','mimes:jpg,jpeg,webp','max:5120'], // 5MB
        ];
    }
}