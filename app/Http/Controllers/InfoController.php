<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'contact_number' => 'required|string',
            'facebook' => 'required|string',
        ]);

        // Update the shop information
        Info::updateOrCreate([
            'id' => 1
        ], $request->only('name', 'location', 'contact_number', 'facebook'));

        return redirect()->route('staff.footer')->with('success', 'Shop information updated successfully.');
    }
}
