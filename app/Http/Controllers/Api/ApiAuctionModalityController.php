<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionModalityResource;
use App\Models\AuctionModality;

class ApiAuctionModalityController extends Controller
{
    public function index()
    {
        return AuctionModalityResource::collection(
            AuctionModality::where('is_active', true)
                ->orderBy('id')
                ->get()
        );
    }
}
