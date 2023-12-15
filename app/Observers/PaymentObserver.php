<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Transaction;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        Transaction::create([
            'user_id' => $payment->user_id,
            'transaction_log' => auth()->user()->name . ' created the payment #' . $payment->id . ' and it has a status of ' . $this->checkStatus($payment->status),
        ]);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        Transaction::create([
            'user_id' => $payment->user_id,
            'transaction_log' => auth()->user()->name . ' updated the payment #' . $payment->id . ' and it has a status of ' . $this->checkStatus($payment->status),
        ]);
    }

    public function checkStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return 'PENDING';
                break;
            case 1:
                return 'APPROVED';
                break;
            default:
                return 'INVALID STATUS';
                break;
        }
    }
}
