<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\GeneralCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Contact;
use App\Models\ContactFormRecipient;
use App\Enums\ContactFormSection;
use App\Models\AuctionType;
use App\Models\AuctionModality;
use Illuminate\View\View;

class ConfigurationController extends Controller
{
    public function index()
    {
        $generalCategories = GeneralCategory::orderBy('name')->get();

        $categories = Category::with('generalCategory')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::with('category.generalCategory')
            ->orderBy('name')
            ->get();        

        $contacts = Contact::with('generalCategory')
            ->latest('id')
            ->get();

        // Contacto activo por sección, para filtrar el selector en los modales
        $activeContactsBySection = $contacts
            ->where('is_active', true)
            ->whereNotNull('general_category_id')
            ->mapWithKeys(fn ($c) => [$c->general_category_id => ['id' => $c->id, 'name' => $c->name]]);

        $contactFormRecipients = ContactFormRecipient::latest('id')->get();

        $contactFormSections = collect(ContactFormSection::cases())
            ->map(fn ($s) => ['id' => $s->value, 'name' => $s->label()])
            ->values();

        // Email activo por sección, para filtrar el selector en los modales
        $activeRecipientsBySection = $contactFormRecipients
            ->where('is_active', true)
            ->mapWithKeys(fn ($r) => [$r->section->value => ['id' => $r->id, 'name' => $r->email]]);

        $auctionTypes = AuctionType::orderBy('name')->get();

        $auctionModalities = AuctionModality::orderBy('name')->get();

        return view('admin.configuration.index', compact(
            'generalCategories',
            'categories',
            'subcategories', 
            'contacts',
            'activeContactsBySection',
            'contactFormRecipients',
            'contactFormSections',
            'activeRecipientsBySection',
            'auctionTypes',
            'auctionModalities'
        ));
    }
}
