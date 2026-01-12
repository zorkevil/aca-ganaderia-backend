<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\AuctionModality\StoreAuctionModalityRequest;
use App\Http\Requests\Admin\Configuration\AuctionModality\UpdateAuctionModalityRequest;
use App\Models\AuctionModality;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AuctionModalityController extends Controller
{
    public function store(StoreAuctionModalityRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon_path'] = $request->file('icon')
                ->store('auction-modalities', 'public');
        }

        AuctionModality::create($data);

        return back()->with('status', 'Modalidad de remate creada correctamente.');
    }

    public function update(
        UpdateAuctionModalityRequest $request,
        AuctionModality $auctionModality
    ): RedirectResponse {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($auctionModality->icon_path) {
                Storage::disk('public')->delete($auctionModality->icon_path);
            }

            $data['icon_path'] = $request->file('icon')
                ->store('auction-modalities', 'public');
        }

        $auctionModality->update($data);

        return back()->with('status', 'Modalidad de remate actualizada correctamente.');
    }
}
