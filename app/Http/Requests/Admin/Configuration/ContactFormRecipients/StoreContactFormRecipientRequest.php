<?php

namespace App\Http\Requests\Admin\Configuration\ContactFormRecipients;

use App\Enums\ContactFormSection;
use App\Models\ContactFormRecipient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreContactFormRecipientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'section' => ['required', Rule::enum(ContactFormSection::class)],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty() || !$this->boolean('is_active')) {
                    return;
                }

                $current = ContactFormRecipient::activeInSection($this->input('section'), null);

                if ($current) {
                    $validator->errors()->add(
                        'section',
                        "La sección {$current->section->label()} ya tiene un email activo ({$current->email}). Desactivalo primero."
                    );
                }
            },
        ];
    }
}
