<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function index(User $user, Request $request)
    {
        if (Gate::allows('customer')) {
            $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                ->where('transactions.user_id', auth()->user()->id)
                ->orderBy('transactions.created_at', 'desc')
                ->paginate(10);

            return view('customer.transaction-logs', compact('transactions'));
        } else {
            $transactions = Transaction::query()
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->when($request->userSearch, function ($q) use ($request) {
                    $q->where('users.name', 'LIKE', '%' . $request->userSearch . '%');
                })
                ->orderBy('transactions.created_at', 'desc')
                ->paginate(10);

            return view('staff.transaction-logs', compact('transactions'));
        }
    }
    public function homepage()
    {
        return view('auth.homepage');
    }
    public function info()
    {
        $info = Info::select('name', 'location', 'contact_number', 'facebook')->first();
    
        return view('auth.homepage', compact('info'));
    }
    // public function editFooter()
    // {
    //     $info = Info::first(); // Retrieve the shop information
    //     return view('admin.footer', compact('info'));
    // }

    public function updateFooter(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact_number' => 'required',
            'facebook' => 'required',
        ]);

        // Update the shop information
        Info::updateOrCreate([], $request->only('name', 'location', 'contact_number', 'facebook'));

        return redirect()->route('staff.footer')->with('success', 'Shop information updated successfully.');
    }
}
