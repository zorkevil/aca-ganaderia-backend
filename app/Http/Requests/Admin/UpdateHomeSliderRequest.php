<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHomeSliderRequest extends FormRequest
{
  public function authorize(): bool
  {
    return auth()->check() && auth()->user()->is_admin;
  }

  public function rules(): array
  {
    return [
      'text' => ['required', 'string', 'max:2000'],
      'alt' => ['required','string','max:125'],
      'link' => ['nullable','url','max:2048'],
      'sort_order' => [
          'required',
          'integer',
          'min:1',
          Rule::unique('home_sliders', 'sort_order')
              ->ignore($this->homeSlider->id),
      ],
      'is_active' => ['required','boolean'],
      'image' => ['nullable','image','mimes:jpg,jpeg,webp','max:5120'],
    ];
  }
}
