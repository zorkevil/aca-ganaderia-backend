<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionTypeResource;
use App\Models\AuctionType;

class ApiAuctionTypeController extends Controller
{
    public function index()
    {
        return AuctionTypeResource::collection(
            AuctionType::where('is_active', true)
                ->orderBy('id')
                ->get()
        );
    }
}
