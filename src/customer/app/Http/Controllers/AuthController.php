<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::beginTransaction();

        try {
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'type' => 'customer',
            ]);

            // Create customer record
            Customer::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'balance' => 0,
                'points' => 0,
            ]);


            DB::commit();

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error' => 'An error occurred during registration. Please try again.'
            ])->withInput();
        }
    }

    /**
     * Handle logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('auth.profile');
    }

    /**
     * Show the transaction history.
     *
     * @return \Illuminate\View\View
     */
    public function history()
    {
        $user = Auth::user();
        $transactions = collect();

        if ($user->customer) {
            $transactions = $user->customer->transactions()
                ->with(['vehicleType', 'packageType'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('auth.history', compact('transactions'));
    }
}
