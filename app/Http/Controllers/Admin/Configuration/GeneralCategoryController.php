<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\GeneralCategory;
use App\Http\Requests\Admin\Configuration\GeneralCategories\StoreGeneralCategoryRequest;
use App\Http\Requests\Admin\Configuration\GeneralCategories\UpdateGeneralCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class GeneralCategoryController extends Controller
{
    public function store(StoreGeneralCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $generalCategory = new GeneralCategory($data);

        if ($request->hasFile('icon')) {
            $generalCategory->icon_path = $request->file('icon')
                ->store('general-categories', 'images');
        }

        $generalCategory->save();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Servicio Principal creado.');
    }

    public function update(UpdateGeneralCategoryRequest $request, GeneralCategory $generalCategory): RedirectResponse
    {
        $data = $request->validated();
        $generalCategory->fill($data);

        if ($request->hasFile('icon')) {
            if ($generalCategory->icon_path) {
                Storage::disk('images')->delete($generalCategory->icon_path);
            }

            $generalCategory->icon_path = $request->file('icon')
                ->store('general-categories', 'images');
        }

        $generalCategory->save();
        
        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Servicio Principal actualizado.');
    }

    public function destroy(GeneralCategory $generalCategory): RedirectResponse
    {
        if ($generalCategory->icon_path) {
            Storage::disk('images')->delete($generalCategory->icon_path);
        }

        $generalCategory->delete();

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Servicio Principal eliminado.');
    }
}
