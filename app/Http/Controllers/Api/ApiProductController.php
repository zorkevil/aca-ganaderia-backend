<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->with(['generalCategory', 'category', 'subcategory'])
            ->where('is_active', true);

        // Filtro por sección (nutricion / sanidad)
        if ($request->filled('general_category')) {
            $query->whereHas('generalCategory', function ($q) use ($request) {
                $q->where('slug', $request->general_category);
            });
        }

        // Orden (hoy simple, mañana expandible)
        match ($request->get('sort')) {
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'recent'     => $query->orderByDesc('date'),
            default      => $query->orderByDesc('sales'),
        };

        $products = $query->paginate(
            perPage: $request->integer('per_page', 6)
        );

        return ProductResource::collection($products);
    }

    public function show(string $slug)
    {
        $product = Product::with(['generalCategory', 'category', 'subcategory'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new ProductResource($product);
    }
}
