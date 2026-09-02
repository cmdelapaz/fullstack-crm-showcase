<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'data' => [
                'open_leads' => Lead::query()->where('status', 'open')->count(),
                'active_clients' => Client::query()->where('status', 'active')->count(),
                'open_jobs' => Job::query()->whereIn('status', ['scheduled', 'in_progress'])->count(),
                'outstanding_balance' => (float) Invoice::query()
                    ->whereIn('status', ['sent', 'partial', 'overdue'])
                    ->sum('balance_due'),
            ],
        ]);
    }
}
