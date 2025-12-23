<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\GeneralCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Contact;
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

        return view('admin.configuration.index', compact(
            'generalCategories',
            'categories',
            'subcategories', 
            'contacts'
        ));
    }
}
