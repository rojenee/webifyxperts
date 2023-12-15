<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::whereHas('roles', function ($q) {
            $q->where('role_id',  1);
        })->get();

        $staff = User::whereHas('roles', function ($q) {
            $q->where('role_id',  2);
        })->get();

        $totalLaundry = Laundry::all()->count();

        $orders = Order::with('laundries')->get()->each(function ($order) {
            return $order->laundries->sum('pivot.price');
        });

        return view('staff.dashboard', [
            'totalCustomerCount' => $customer->count(),
            'totalStaffCount' => $staff->count(),
            'totalLaundry' => $totalLaundry,
            'orders' => $orders
        ]);
    }
}
