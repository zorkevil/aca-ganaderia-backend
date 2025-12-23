<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\Services\StoreServiceRequest;
use App\Http\Requests\Admin\Configuration\Services\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $service = new Service([
            'section'   => $data['section'],
            'title'     => $data['title'],
            'icon_alt'  => $data['icon_alt'] ?? null,
            'is_active' => $data['is_active'],
        ]);

        if ($request->hasFile('icon')) {
            $service->icon_path = $request->file('icon')
                ->store('section-services', 'images');
        }

        $service->save();

        return back()->with('status', 'Servicio creado.');
    }

    public function update(UpdateServiceRequest $request, string $section, Service $sectionService): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($sectionService->icon_path) {
                Storage::disk('images')->delete($sectionService->icon_path);
            }

            $sectionService->icon_path = $request->file('icon')
                ->store('section-services', 'images');
        }

        $sectionService->update([
            'title'     => $data['title'],
            'icon_alt'  => $data['icon_alt'] ?? null,
            'is_active' => $data['is_active'],
        ]);

        return back()->with('status', 'Servicio actualizado.');
    }

    public function destroy(string $section, Service $sectionService): RedirectResponse
    {
        if ($sectionService->icon_path) {
            Storage::disk('images')->delete($sectionService->icon_path);
        }

        $sectionService->delete();

        return back()->with('status', 'Servicio eliminado.');
    }
}
