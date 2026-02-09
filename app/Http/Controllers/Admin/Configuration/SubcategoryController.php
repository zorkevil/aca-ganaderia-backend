<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Requests\Admin\Configuration\Subcategories\StoreSubcategoryRequest;
use App\Http\Requests\Admin\Configuration\Subcategories\UpdateSubcategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function store(StoreSubcategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            
            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'subcategories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $subcategory = new Subcategory($data);

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Subcategoría creada.');
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($subcategory->icon_path) {
                Storage::disk('images')->delete($subcategory->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'subcategories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $subcategory->update($data);

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Subcategoría actualizada.');
    }

    public function destroy(Subcategory $subcategory): RedirectResponse
    {
        if ($subcategory->icon_path) {
            Storage::disk('images')->delete($subcategory->icon_path);
        }

        $subcategory->delete();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Subcategoría eliminada.');
    }
}
