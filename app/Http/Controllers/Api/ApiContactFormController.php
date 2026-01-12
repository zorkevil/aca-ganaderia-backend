<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactFormRequest;
use App\Models\ContactForm;
use Illuminate\Http\JsonResponse;

class ApiContactFormController extends Controller
{
    public function store(StoreContactFormRequest $request): JsonResponse
    {
        $contact = ContactForm::create($request->validated());

        return response()->json([
            'success' => true,
            'id' => $contact->id,
        ], 201);
    }
}
