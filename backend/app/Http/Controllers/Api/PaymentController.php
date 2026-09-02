<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(
        Request $request,
        Invoice $invoice,
        PaymentService $service
    ): JsonResponse {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'gt:0'],
            'method' => ['required', 'string', 'in:card,cash,check,ach'],
            'reference' => ['nullable', 'string', 'max:100'],
            'paid_at' => ['nullable', 'date'],
        ]);

        $payment = $service->record($invoice, $validated);

        return response()->json([
            'message' => 'Payment recorded successfully.',
            'data' => $payment,
        ], 201);
    }
}
