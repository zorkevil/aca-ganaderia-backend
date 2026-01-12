<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\AuctionText;
use Illuminate\Http\Request;

class AuctionTextController extends Controller
{
    public function update(Request $request, AuctionText $auctionText)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $auctionText->update([
            'description' => $request->description,
        ]);

        return redirect()
            ->back()
            ->with('status', 'Texto de remates actualizado');
    }
}
