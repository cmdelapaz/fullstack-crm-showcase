<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class LeadConversionService
{
    public function convert(Lead $lead): Client
    {
        if ($lead->status === 'converted') {
            throw new RuntimeException('Lead has already been converted.');
        }

        return DB::transaction(function () use ($lead): Client {
            $client = Client::create([
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'source' => $lead->source,
            ]);

            $lead->update([
                'status' => 'converted',
                'converted_client_id' => $client->id,
                'converted_at' => now(),
            ]);

            return $client;
        });
    }
}
