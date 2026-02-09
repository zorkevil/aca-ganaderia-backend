<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\AuctionType\StoreAuctionTypeRequest;
use App\Http\Requests\Admin\Configuration\AuctionType\UpdateAuctionTypeRequest;
use App\Models\AuctionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AuctionTypeController extends Controller
{
    public function store(StoreAuctionTypeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'auction-types';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        AuctionType::create($data);

        return back()->with('status', 'Tipo de remate creado correctamente.');
    }

    public function update(
        UpdateAuctionTypeRequest $request,
        AuctionType $auctionType
    ): RedirectResponse {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($auctionType->icon_path) {
                Storage::disk('images')->delete($auctionType->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'auction-types';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $auctionType->update($data);

        return back()->with('status', 'Tipo de remate actualizado correctamente.');
    }
}
