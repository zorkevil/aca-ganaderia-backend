<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCategoryResource;
use App\Models\GeneralCategory;

class ApiGeneralCategoryController extends Controller
{
    public function index()
    {
        return GeneralCategoryResource::collection(
            GeneralCategory::where('is_active', true)
                ->orderBy('id')
                ->get()
        );
    }
}
