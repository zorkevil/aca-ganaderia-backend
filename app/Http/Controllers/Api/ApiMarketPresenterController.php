<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketPresenterResource;
use App\Models\MarketPresenter;
use Illuminate\Http\JsonResponse;

class ApiMarketPresenterController extends Controller
{
    public function show(): JsonResponse
    {
        $presenter = MarketPresenter::first();

        if (!$presenter) {
            return response()->json([
                'data' => null
            ]);
        }

        return response()->json([
            'data' => new MarketPresenterResource($presenter),
        ]);
    }
}
