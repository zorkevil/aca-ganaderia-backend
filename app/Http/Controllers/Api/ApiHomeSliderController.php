<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeSliderResource;
use App\Models\HomeSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiHomeSliderController extends Controller
{
    /**
     * Obtener todos los sliders activos ordenados
     */
    public function index(): AnonymousResourceCollection
    {
        $sliders = HomeSlider::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return HomeSliderResource::collection($sliders);
    }

    /**
     * Obtener un slider específico
     */
    public function show(HomeSlider $homeSlider): HomeSliderResource|JsonResponse
    {
        if (!$homeSlider->is_active) {
            return response()->json([
                'message' => 'Slider no disponible'
            ], 404);
        }

        return new HomeSliderResource($homeSlider);
    }
}