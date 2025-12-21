<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiReportController extends Controller
{
    /**
     * Obtener todos los informes activos ordenados por fecha
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = min(
            $request->input('per_page', config('pagination.reports')),
            config('pagination.max_per_page') // límite máximo
        );
        
        $reports = Report::where('is_active', true)
            ->latest('date')
            ->paginate($perPage);

        return ReportResource::collection($reports);
    }

    /**
     * Obtener un informe específico
     */
    public function show(Report $report): ReportResource|JsonResponse
    {
        if (!$report->is_active) {
            return response()->json([
                'message' => 'Informe no disponible'
            ], 404);
        }

        return new ReportResource($report);
    }
}