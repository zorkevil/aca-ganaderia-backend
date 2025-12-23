<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Product;
use App\Models\GeneralCategory;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // IDs fijos por slug (para los modales)
        $nutritionId = GeneralCategory::where('slug', 'nutricion')->value('id');
        $sanidadId   = GeneralCategory::where('slug', 'sanidad')->value('id');

        // Categorías filtradas por tipo
        $categoriesNutrition = Category::where('general_category_id', $nutritionId)
            ->orderBy('name')
            ->get();

        $categoriesSanidad = Category::where('general_category_id', $sanidadId)
            ->orderBy('name')
            ->get();

        // Subcategorías de Sanidad (derivadas de sus categorías)
        $subcategoriesSanidad = Subcategory::whereIn(
                'category_id',
                $categoriesSanidad->pluck('id')
            )
            ->orderBy('name')
            ->get();

        // Listado de productos
        $products = Product::with([
                'generalCategory',
                'category',
                'subcategory',
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(config('pagination.products'))
            ->withQueryString();

        return view('admin.products.index', compact(
            'products',
            'nutritionId',
            'sanidadId',
            'categoriesNutrition',
            'categoriesSanidad',
            'subcategoriesSanidad'
        ));
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $product = new Product($data);

        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')
                ->store('products', 'images');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Producto creado correctamente.');
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        $product->fill($data);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('images')->delete($product->image_path);
            }

            $product->image_path = $request->file('image')
                ->store('products', 'images');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image_path) {
            Storage::disk('images')->delete($product->image_path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Producto eliminado correctamente.');
    }
}
