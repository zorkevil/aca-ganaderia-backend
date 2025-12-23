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

        $subcategory = new Subcategory($data);

        if ($request->hasFile('icon')) {
            $subcategory->icon_path = $request->file('icon')
                ->store('subcategories', 'images');
        }

        $subcategory->save();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Subcategoría creada.');
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory): RedirectResponse
    {
        $data = $request->validated();
        $subcategory->fill($data);

        if ($request->hasFile('icon')) {
            if ($subcategory->icon_path) {
                Storage::disk('images')->delete($subcategory->icon_path);
            }

            $subcategory->icon_path = $request->file('icon')
                ->store('subcategories', 'images');
        }

        $subcategory->save();

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
