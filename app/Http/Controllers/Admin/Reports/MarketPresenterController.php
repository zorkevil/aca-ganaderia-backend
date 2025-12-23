<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MarketPresenter\UpdateMarketPresenterRequest;
use App\Models\MarketPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MarketPresenterController extends Controller
{
    public function update(UpdateMarketPresenterRequest $request, MarketPresenter $marketPresenter): RedirectResponse
    {
        $data = $request->validated();

        $marketPresenter->fill([
            'description' => $data['description'] ?? null,
            'alt' => $data['alt'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        if ($request->hasFile('image')) {
            if ($marketPresenter->image_path) {
                Storage::disk('images')->delete($marketPresenter->image_path);
            }

            $marketPresenter->image_path = $request->file('image')
                ->store('market-presenter', 'images');
        }

        $marketPresenter->save();

        return redirect()
            ->back()
            ->with('status', 'Presentación de informes actualizada.');
    }
}
