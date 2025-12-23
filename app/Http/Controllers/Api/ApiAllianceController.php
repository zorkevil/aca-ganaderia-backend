<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllianceResource;
use App\Models\Alliance;
use App\Models\AllianceText;
use Illuminate\Http\JsonResponse;

class ApiAllianceController extends Controller
{
    public function index(): JsonResponse
    {
        $text = AllianceText::first();

        $alliances = Alliance::where('is_active', true)
            ->orderBy('id')
            ->get();

        return response()->json([
            'text'  => $text?->description,
            'items' => AllianceResource::collection($alliances),
        ]);
    }
}
