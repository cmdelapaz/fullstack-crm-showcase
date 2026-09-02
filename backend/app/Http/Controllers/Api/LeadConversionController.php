<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\LeadConversionService;
use Illuminate\Http\JsonResponse;

class LeadConversionController extends Controller
{
    public function __invoke(
        Lead $lead,
        LeadConversionService $service
    ): JsonResponse {
        $client = $service->convert($lead);

        return response()->json([
            'message' => 'Lead converted successfully.',
            'data' => $client,
        ], 201);
    }
}
