<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use App\Models\AuctionText;
use Illuminate\Http\JsonResponse;

class ApiAuctionController extends Controller
{
    public function index(): JsonResponse
    {
        $text = AuctionText::first();

        $auctions = Auction::with(['modality', 'type'])
            ->where('is_active', true)
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'text'  => $text?->description,
            'items' => AuctionResource::collection($auctions),
        ]);
    }
}
