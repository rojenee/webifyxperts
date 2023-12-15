<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    public function viewPayment()
    {
        if (Gate::allows('customer')) {
            $payments = Payment::with('user')
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
            return view('customer.payments.view-payments', compact('payments'));
        } else {
            $payments = Payment::with('user')->latest()->paginate(10);
            return view('staff.payments.view-payments', compact('payments'));
        }
    }

    public function createPayment()
    {
        $laundries = Laundry::where('user_id', auth()->user()->id)
            ->latest()->get();
        return view('customer.payments.add-payments', compact('laundries'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'laundry' => ['required'],
            'screenshot' => ['required', 'image', 'mimes:png,jpg', 'max:4096']
        ]);

        try {
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');

                // get new uploaded file and upload to public path
                $screenshot = time() . '_' . trim(auth()->user()->name) . '_' . $file->getClientOriginalName();
                $file->move(public_path('/payments'), $screenshot);

                Payment::create([
                    'user_id' => auth()->user()->id,
                    'laundry_id' => $request->laundry,
                    'screenshot' => $screenshot,
                ]);

                return back()->with('success', 'Payment Created');
            } else {
                return back()->with('danger', 'Payment Not Created');
            }
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => ['required', 'numeric']
        ]);

        try {
            $payment->updateOrFail([
                'status' => $request->status
            ]);
            return back()->with('success', 'Payment Status Updated');
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function destroyPayment(Payment $payment)
    {
        try {
            // check if file is existing in the uploads folder
            if (file_exists("payments/" . $payment->screenshot)) {
                // remove the uploaded file
                unlink("payments/" . $payment->screenshot);
            }

            $payment->deleteOrFail();
            return back()->with('success', 'Payment Deleted');
        } catch (Exception $e) {
            abort(500);
        }
    }
}
