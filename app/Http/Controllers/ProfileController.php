<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Info;


class ProfileController extends Controller
{
    public function customerProfilePage()
    {
        return view('customer.profile');
    }

    public function staffProfilePage()
    {
        return view('staff.profile');
    }
    public function staffFooterPage()
    {
        $info = Info::first();
        return view('staff.footer', compact('info'));
    }

    public function updateProfile(Request $request)
    {
        // validate profile info first
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'image' => ['nullable', 'image', 'mimes:png,jpg', 'max:4096'],
            'new_password' => ['nullable', 'different:old_password']
        ]);

        try {
            // find current logged in user
            $user = User::findOrFail(auth()->user()->id);

            // check if the user has uploaded an profile image
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // check if file is existing in the uploads folder
                if (auth()->user()->image != null && file_exists("uploads/" . auth()->user()->image)) {
                    // remove the uploaded file
                    unlink("uploads/" . auth()->user()->image);
                }

                // get new uploaded file and upload to public path
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/uploads'), $fileName);

                // if there password existing in the input
                if ($request->new_password != null && $request->old_password != null) {
                    // check if old password or new password has 8 characters
                    if (strlen($request->old_password) < 8 || strlen($request->new_password) < 8) {
                        return back()->with('error', 'Old and new password must be atleast 8 characters');
                    }

                    // compare if old password matches the old password in the database
                    if (!Hash::check($request->old_password, auth()->user()->password)) {
                        return back()->with('error', 'Please enter your correct old password before changing to new');
                    }

                    // update the name, email, image and password
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'image' => $fileName,
                        'password' => $request->new_password
                    ]);

                    return back()->with('success', 'Profile Updated!');
                } else {
                    // update the name, email and image
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'image' => $fileName
                    ]);

                    return back()->with('success', 'Profile Updated!');
                }
            } else {
                // if there is no uploaded image and password is existing in the input
                if ($request->new_password != null && $request->old_password != null) {
                    // check if old password or new password has 8 characters
                    if (strlen($request->old_password) < 8 || strlen($request->new_password) < 8) {
                        return back()->with('error', 'Old and new password must be atleast 8 characters');
                    }

                    // compare if old password matches the old password in the database
                    if (!Hash::check($request->old_password, auth()->user()->password)) {
                        return back()->with('error', 'Please enter your correct old password before changing to new');
                    }

                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->new_password
                    ]);

                    return back()->with('success', 'Profile Updated!');
                } else {
                    // update only name and email if there is no image uploaded
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email
                    ]);

                    return back()->with('success', 'Profile Updated!');
                }
            }
        } catch (Exception $e) {
            // if something went wrong abort the page
            abort(500);
        }
    }
 
}
