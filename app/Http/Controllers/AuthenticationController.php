<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginn');
    }
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }
    public function homepage()
    {
        return view('auth.homepage');
    }
    public function authLogin(Request $request)
    {
        // validate form
        $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'min:8']
        ]);

        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            // if invalid credentials, throw error
            if (!auth()->attempt($credentials)) {
                return back()->with('error', 'Email or password is incorrect!')
                    ->withInput($credentials);
            }

            $user = User::whereEmail($request->email)->first();
            $user_roles = [];

            // push all possibles user roles of a user
            foreach ($user->roles as $role) {
                array_push($user_roles, $role->role_name);
            }

            // check if user is staff then redirect to staff
            if (in_array('staff', $user_roles)) {
                return redirect()->route('staff.dashboard')
                    ->with('success', 'Welcome, ' . auth()->user()->name . '!');
            }


            // otherwise redirect to customer
            return redirect()->route('customer.dashboard')
                ->with('success', 'Welcome, ' . auth()->user()->name . '!');
        } catch (Exception $e) {
            // abort page when something went wrong
            abort(500);
        }
    }

    public function authRegister(Request $request)
    {
        // validate form
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:32'],
            'confirm_password' => ['same:password']
        ]);

        try {
            // create a valid user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            // find the current registered user
            $findUser = User::findOrFail($user->id);

            // attach this registered user as customer
            $findUser->roles()->attach(1);

            // throw a success message
            return back()->with('success', 'Account Registered Successfully!');
        } catch (Exception $e) {
            // abort page when something went wrong
            abort(500);
        }
    }

    public function authLogout()
    {
        auth()->logout();
        return redirect()->route('guest.login');
    }
   
}
