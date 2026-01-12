<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ApiSubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::query()
            ->where('is_active', true)
            ->with(['category.generalCategory'])
            ->orderBy('id');

        // Filtro opcional por sección (nutricion / sanidad)
        if ($request->filled('general_category')) {
            $query->whereHas('category.generalCategory', function ($q) use ($request) {
                $q->where('slug', $request->general_category);
            });
        }

        // Filtro opcional por categoría
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        return SubcategoryResource::collection(
            $query->get()
        );
    }
}
