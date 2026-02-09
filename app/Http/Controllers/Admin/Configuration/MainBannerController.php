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

            if ($banner->image_path && Storage::disk('images')->exists($banner->image_path)) {
                Storage::disk('images')->delete($banner->image_path);
            }

            $file = $request->file('image');
            $filename = $file->hashName();
            $directory = "banners/{$section}";

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $$data['image_path'] = $fullPath;
            }   
        }

        $banner->update([
            'image_path' => $data['image_path'] ?? $banner->image_path,
            'image_alt'  => $data['image_alt'] ?? $banner->image_alt,
        ]);

        return back()->with('status', 'Banner actualizado correctamente.');
    }
}