<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GeneralCategory;
use App\Http\Requests\Admin\Configuration\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Configuration\Categories\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $category = new Category($data);

        if ($request->hasFile('icon')) {
            $category->icon_path = $request->file('icon')
                ->store('categories', 'images');
        }

        $category->save();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Categoría creada.');
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $category->fill($data);

        if ($request->hasFile('icon')) {
            if ($category->icon_path) {
                Storage::disk('images')->delete($category->icon_path);
            }

            $category->icon_path = $request->file('icon')
                ->store('categories', 'images');
        }

        $category->save();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Categoría actualizada.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->icon_path) {
            Storage::disk('images')->delete($category->icon_path);
        }

        $category->delete();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Categoría eliminada.');
    }
}
