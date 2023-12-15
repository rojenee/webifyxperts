<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owned_laundries = Laundry::where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);
        return view('customer.laundries.laundries', compact('owned_laundries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.laundries.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laundry_name' => ['required', 'string'],
            'weight_laundry' => ['required', 'decimal:1'],
            'base_price' => ['required', 'decimal:2'],
            'total_laundry_price' => ['required', 'decimal:2'],
        ]);
        try {
            Laundry::create([
                'user_id' => auth()->user()->id,
                'laundry_name' => $request->laundry_name,
                'weight_laundry' => $request->weight_laundry,
                'base_price_per_weight' => $request->base_price,
                'total_laundry_price' => $request->total_laundry_price
            ]);

            return back()->with('success', 'You have placed your laundry successfully');
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laundry $laundry)
    {
        return view('customer.laundries.forms.edit', compact('laundry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laundry $laundry)
    {
        $request->validate([
            'laundry_name' => ['required', 'string'],
            'weight_laundry' => ['required', 'decimal:1'],
            'base_price' => ['required', 'decimal:2'],
            'total_laundry_price' => ['required', 'decimal:2'],
        ]);
        try {
            $laundry->update([
                'laundry_name' => $request->laundry_name,
                'weight_laundry' => $request->weight_laundry,
                'base_price_per_weight' => $request->base_price,
                'total_laundry_price' => $request->total_laundry_price
            ]);

            return back()->with('success', 'You have placed your laundry successfully');
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laundry $laundry)
    {
        try {
            $laundry->deleteOrFail();
            return back()->with('success', 'Laundry Deleted Successfully');
        } catch (Exception $e) {
            abort(500);
        }
    }
    public function homepage()
    {
        return view('customer.homepage');
    }
}
