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

        // Upload icono si existe
        if ($request->hasFile('icon')) {
            $data['icon_path'] = $request->file('icon')
                ->store('auction-types', 'public');
        }

        AuctionType::create($data);

        return back()->with('status', 'Tipo de remate creado correctamente.');
    }

    public function update(
        UpdateAuctionTypeRequest $request,
        AuctionType $auctionType
    ): RedirectResponse {
        $data = $request->validated();

        // Reemplazo de icono
        if ($request->hasFile('icon')) {
            if ($auctionType->icon_path) {
                Storage::disk('public')->delete($auctionType->icon_path);
            }

            $data['icon_path'] = $request->file('icon')
                ->store('auction-types', 'public');
        }

        $auctionType->update($data);

        return back()->with('status', 'Tipo de remate actualizado correctamente.');
    }
}
