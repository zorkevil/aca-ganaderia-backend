<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\Contacts\StoreContactRequest;
use App\Http\Requests\Admin\Configuration\Contacts\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // opcional: normalizar phone
        $data['phone'] = trim($data['phone']);

        Contact::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'general_category_id' => $data['general_category_id'] ?? null,
            'is_active' => (bool) $data['is_active'],
        ]);

        return back()->with('status', 'Contacto creado.');
    }

    public function update(UpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        $data = $request->validated();
        $data['phone'] = trim($data['phone']);

        $contact->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'general_category_id' => $data['general_category_id'] ?? null,
            'is_active' => (bool) $data['is_active'],
        ]);

        return back()->with('status', 'Contacto actualizado.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('status', 'Contacto eliminado.');
    }
}
