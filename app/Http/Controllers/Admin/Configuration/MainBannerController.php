<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\MainBanners\UpdateMainBannerRequest;
use App\Models\MainBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainBannerController extends Controller
{
    public function update(UpdateMainBannerRequest $request, string $section): RedirectResponse
    {
        $banner = MainBanner::where('section', $section)->firstOrFail();

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // borra la anterior si existía
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            // guarda la nueva
            $data['image_path'] = $request->file('image')->store("banners/{$section}", 'public');
        }

        $banner->update([
            'image_path' => $data['image_path'] ?? $banner->image_path,
            'image_alt'  => $data['image_alt'] ?? $banner->image_alt,
        ]);

        return back()->with('status', 'Banner actualizado correctamente.');
    }
}