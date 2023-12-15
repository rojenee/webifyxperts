<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function placeOrder(Laundry $laundry)
    {
        // create an order
        $order = Order::create([
            'user_id' => auth()->user()->id,
        ]);

        // attach customer with placed laundry
        $laundry->orders()->attach($order->id, [
            'price' => $laundry->total_laundry_price
        ]);

        return redirect()->back()
            ->with('success', 'You have successfully placed an order');
    }

    public function updateOrder(Order $order, Request $request)
    {
        $order->update([
            'status' => $request->status
        ]);
        return back()->with('success', 'Order status updated!');
    }

    public function viewOrder(Laundry $laundry)
    {
        $status = new Order;

        if (Gate::allows('customer')) {
            $orders = Order::with(['laundries', 'user'])
                ->where('user_id', auth()->user()->id)
                ->paginate(10);

            return view('customer.orders', compact('orders'), ['status' => $status]);
        } else {
            $orders = Order::with(['laundries', 'user'])->paginate(10);
            return view('staff.orders', compact('orders'), ['status' => $status]);
        }
    }
    public function getMostBookedLaundryTypes()
{
    // Replace this with your actual logic to get most booked laundry types
    $mostBookedLaundryTypes = [
        '5 Kilos and Below' => 30,
        '5 1/2 to 8 Kilos' => 50,
    ];

    return response()->json($mostBookedLaundryTypes);
}
public function getMonthlySales()
{
    $monthlySales = Order::whereMonth('created_at', '=', now()->month)
        ->sum('total_price');

    return response()->json(['monthly_sales' => $monthlySales]);
}

}
