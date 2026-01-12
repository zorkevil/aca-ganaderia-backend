<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query()
            ->where('is_active', true)
            ->with('generalCategory')
            ->orderBy('id');

        // Filtro opcional por sección (nutricion / sanidad)
        if ($request->filled('general_category')) {
            $query->whereHas('generalCategory', function ($q) use ($request) {
                $q->where('slug', $request->general_category);
            });
        }

        return CategoryResource::collection(
            $query->get()
        );
    }
}
