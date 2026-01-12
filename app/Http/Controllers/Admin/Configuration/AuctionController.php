<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\Auction\StoreAuctionRequest;
use App\Http\Requests\Admin\Configuration\Auction\UpdateAuctionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{
    public function store(StoreAuctionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('auctions', 'images');
        }

        Auction::create($data);

        return redirect()
            ->back()
            ->with('status', 'Remate creado correctamente.');
    }

    public function update(UpdateAuctionRequest $request, Auction $auction): RedirectResponse 
    {
        $data = $request->validated();

        $auction->fill([
            'title' => $data['title'],
            'link' => $data['link'] ?? null,
            'auction_modality_id' => $data['auction_modality_id'],
            'auction_type_id' => $data['auction_type_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'description' => $data['description'] ?? null,
            'image_alt' => $data['image_alt'] ?? null,
            'is_active' => (bool) $data['is_active'],
        ]);

        // Imagen
        if ($request->hasFile('image')) {
            if ($auction->image_path) {
                Storage::disk('images')->delete($auction->image_path);
            }

            $auction->image_path = $request->file('image')
                ->store('auctions', 'images');
        }

        $auction->save();

        return redirect()
            ->back()
            ->with('status', 'Remate actualizado.');
    }

    public function destroy(Auction $auction): RedirectResponse
    {
        if ($auction->image_path) {
            Storage::disk('images')->delete($auction->image_path);
        }

        $auction->delete();

        return redirect()
            ->back()
            ->with('status', 'Remate eliminado.');
    }
}
