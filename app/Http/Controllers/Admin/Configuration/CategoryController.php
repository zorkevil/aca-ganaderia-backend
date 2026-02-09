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

        if ($request->hasFile('icon')) {
            
            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'categories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $category = new Category($data);

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Categoría creada.');
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($category->icon_path) {
                Storage::disk('images')->delete($category->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'categories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $category->update($data);

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
