<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);
        return view('customer.bookings.bookings', ['bookings' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.bookings.add-bookings');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laundry_type' => ['required', 'string'],
            'booked_date' => ['required', 'date'],
        ]);

        try {
            Booking::create([
                'user_id' => auth()->user()->id,
                'laundry_type' => $request->laundry_type,
                'booked_date' => $request->booked_date,
            ]);

            return back()->with('success', 'Booking Created Successfully!');
        } catch (Exception $e) {
            abort(500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('customer.bookings.edit-bookings', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'laundry_type' => ['required', 'string'],
            'booked_date' => ['required', 'date'],
        ]);

        try {
            $booking->update([
                'laundry_type' => $request->laundry_type,
                'booked_date' => $request->booked_date,
            ]);

            return back()->with('success', 'Booking Updated Successfully!');
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try {
            $booking->deleteOrFail();
            return back()->with('success', 'Booking Deleted!');
        } catch (Exception $e) {
            abort(500);
        }
    }
}
