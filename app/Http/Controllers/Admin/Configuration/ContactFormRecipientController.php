<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\ContactFormRecipients\StoreContactFormRecipientRequest;
use App\Http\Requests\Admin\Configuration\ContactFormRecipients\UpdateContactFormRecipientRequest;
use App\Models\ContactFormRecipient;
use Illuminate\Http\RedirectResponse;

class ContactFormRecipientController extends Controller
{
    public function store(StoreContactFormRecipientRequest $request): RedirectResponse
    {
        ContactFormRecipient::create($request->validated());

        return back()->with('status', 'Email creado.');
    }

    public function update(UpdateContactFormRecipientRequest $request, ContactFormRecipient $contactFormRecipient): RedirectResponse
    {
        $contactFormRecipient->update($request->validated());

        return back()->with('status', 'Email actualizado.');
    }

    public function destroy(ContactFormRecipient $contactFormRecipient): RedirectResponse
    {
        $contactFormRecipient->delete();

        return back()->with('status', 'Email eliminado.');
    }
}
