<?php

namespace App\Http\Controllers\Staff;

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
        $bookings = Booking::with('user')->paginate(10);
        return view('staff.bookings.bookings', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('staff.bookings.edit-bookings', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'laundry_type' => ['required', 'string'],
            'booked_date' => ['required', 'date'],
            'status' => ['required', 'numeric']
        ]);

        try {
            $booking->update([
                'laundry_type' => $request->laundry_type,
                'booked_date' => $request->booked_date,
                'status' => $request->status
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
