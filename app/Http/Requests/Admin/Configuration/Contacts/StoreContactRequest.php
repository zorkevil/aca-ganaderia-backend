<?php

namespace App\Http\Requests\Admin\Configuration\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreContactRequest extends FormRequest
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

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty() || !$this->boolean('is_active')) {
                    return;
                }

                $current = Contact::activeInSection((int) $this->input('general_category_id'), null);

                if ($current) {
                    $validator->errors()->add(
                        'general_category_id',
                        "La sección {$current->generalCategory->name} ya tiene un contacto activo ({$current->name}). Desactivalo primero."
                    );
                }
            },
        ];
    }
}
