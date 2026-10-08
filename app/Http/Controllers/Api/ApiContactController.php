<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ApiContactController extends Controller
{
    public function index(): JsonResponse
    {
        $contacts = Contact::with('generalCategory')
            ->active()
            ->get();

        return response()->json([
            'data' => ContactResource::collection($contacts),
        ]);
    }
}
