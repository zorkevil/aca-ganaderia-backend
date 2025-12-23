<?php

namespace App\Http\Controllers\Admin\Home;

use App\Models\HomeSlider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Home\Sliders\StoreHomeSliderRequest;
use App\Http\Requests\Admin\Home\Sliders\UpdateHomeSliderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function store(StoreHomeSliderRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $slider = new HomeSlider([
            'text' => $data['text'],
            'alt' => $data['alt'],
            'link' => $data['link'] ?? null,
            'sort_order' => (int) $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        if ($request->hasFile('image')) {
            $slider->image_path = $request->file('image')
                ->store('home/sliders', 'images');
        }

        $slider->save();

        return redirect()
            ->route('admin.home')
            ->with('status', 'Slider creado.');
    }

    public function update(UpdateHomeSliderRequest $request, HomeSlider $homeSlider): RedirectResponse
    {
        $data = $request->validated();

        $homeSlider->fill([
            'text' => $data['text'],
            'alt' => $data['alt'],
            'link' => $data['link'] ?? null,
            'sort_order' => (int) $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        if ($request->hasFile('image')) {
            if ($homeSlider->image_path) {
                Storage::disk('images')->delete($homeSlider->image_path);
            }

            $homeSlider->image_path = $request->file('image')
                ->store('home/sliders', 'images');
        }

        $homeSlider->save();

        return redirect()
            ->route('admin.home')
            ->with('status', 'Slider actualizado.');
    }

    public function destroy(HomeSlider $homeSlider): RedirectResponse
    {
        if ($homeSlider->image_path) {
            Storage::disk('images')->delete($homeSlider->image_path);
        }

        $homeSlider->delete();

        return redirect()
            ->route('admin.home')
            ->with('status', 'Slider eliminado.');
    }
}
