<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainBannerResource;
use App\Models\MainBanner;
use Illuminate\Http\JsonResponse;

class ApiMainBannerController extends Controller
{
    public function show(string $section): JsonResponse
    {
        $banner = MainBanner::where('section', $section)->first();

        if (!$banner) {
            return response()->json([
                'data' => null,
            ]);
        }

        return response()->json([
            'data' => new MainBannerResource($banner),
        ]);
    }
}
