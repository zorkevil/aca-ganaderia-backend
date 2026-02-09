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

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'auction-modalities';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
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
                Storage::disk('images')->delete($auctionModality->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'auction-modalities';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $auctionModality->update($data);

        return back()->with('status', 'Modalidad de remate actualizada correctamente.');
    }
}
