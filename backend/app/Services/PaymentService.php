<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PaymentService
{
    public function record(Invoice $invoice, array $data): Payment
    {
        $amount = (float) $data['amount'];

        if ($amount <= 0) {
            throw new InvalidArgumentException('Payment amount must be greater than zero.');
        }

        if ($amount > $invoice->balance_due) {
            throw new InvalidArgumentException('Payment cannot exceed the invoice balance.');
        }

        return DB::transaction(function () use ($invoice, $data, $amount): Payment {
            $payment = $invoice->payments()->create([
                'amount' => $amount,
                'method' => $data['method'],
                'reference' => $data['reference'] ?? null,
                'paid_at' => $data['paid_at'] ?? now(),
            ]);

            $paidTotal = (float) $invoice->payments()->sum('amount');
            $balanceDue = max(0, (float) $invoice->total - $paidTotal);

            $invoice->update([
                'amount_paid' => $paidTotal,
                'balance_due' => $balanceDue,
                'status' => $balanceDue === 0.0 ? 'paid' : 'partial',
            ]);

            return $payment;
        });
    }
}
