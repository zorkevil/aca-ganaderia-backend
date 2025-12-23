<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ApiServiceController extends Controller
{
    public function bySection(string $section): JsonResponse
    {
        $services = Service::where('section', $section)
            ->where('is_active', true)
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => ServiceResource::collection($services),
        ]);
    }
}
