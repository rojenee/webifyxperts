<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLaundryCount = Laundry::where('user_id', auth()->user()->id)
            ->get()->count();

        $totalPendingLaundry = Laundry::whereHas('user', function ($q) {
            $q->where('id', auth()->user()->id);
        })->whereHas('orders', function ($q) {
            $q->where('status', 0);
        })->count();

        $totalFinishedLaundry = Laundry::whereHas('user', function ($q) {
            $q->where('id', auth()->user()->id);
        })->whereHas('orders', function ($q) {
            $q->where('status', 2);
        })->count();

        return view(
            'customer.dashboard',
            [
                'totalLaundryCount' => $totalLaundryCount,
                'totalPendingLaundry' => $totalPendingLaundry,
                'totalFinishedLaundry' => $totalFinishedLaundry
            ]
        );
    }

}
