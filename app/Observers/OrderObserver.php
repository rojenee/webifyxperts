<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Transaction;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Transaction::create([
            'user_id' => $order->user_id,
            'transaction_log' => auth()->user()->name . ' created the order #' . $order->id . ' and it has a status of ' . $this->checkStatus($order->status),
        ]);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        Transaction::create([
            'user_id' => $order->user_id,
            'transaction_log' => auth()->user()->name . ' update the order #' . $order->id . ' and it has a status of ' . $this->checkStatus($order->status),
        ]);
    }

    public function checkStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return 'PENDING';
                break;
            case 1:
                return 'IN PROGRESS';
                break;
            case 2:
                return 'FINISHED';
                break;
            case 3:
                return 'CANCELLED';
                break;
            default:
                return 'INVALID STATUS';
                break;
        }
    }
}
