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

        if ($request->hasFile('icon')) {
            
            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'general-categories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $generalCategory = new GeneralCategory($data);

        return redirect()
            ->route('admin.configuration.index')
            ->with('status', 'Servicio Principal creado.');
    }

    public function update(UpdateGeneralCategoryRequest $request, GeneralCategory $generalCategory): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($generalCategory->icon_path) {
                Storage::disk('images')->delete($generalCategory->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'general-categories';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $generalCategory->update($data);
        
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
