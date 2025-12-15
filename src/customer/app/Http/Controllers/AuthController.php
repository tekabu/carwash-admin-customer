<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;

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

    /**
     * Show the top up page with history and submission form.
     *
     * @return \Illuminate\View\View
     */
    public function topUp()
    {
        $user = Auth::user();
        $topUps = collect();
        $customerId = optional($user->customer)->id;

        if ($user->customer) {
            $topUps = $user->customer->topUps()
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $topUpEndpointTemplate = config('services.customer_top_up.url_template');
        $topUpEndpoint = $this->resolveCustomerTopUpEndpoint($topUpEndpointTemplate, $customerId);

        return view('auth.top-up', compact('topUps', 'topUpEndpoint', 'topUpEndpointTemplate', 'customerId'));
    }

    /**
     * Resolve the configured customer top up URL for a specific customer.
     */
    protected function resolveCustomerTopUpEndpoint(?string $template, ?int $customerId): ?string
    {
        if (! $template || ! $customerId) {
            return null;
        }

        if (Str::contains($template, '{customer_id}')) {
            return str_replace('{customer_id}', $customerId, $template);
        }

        if (Str::contains($template, '{customerId}')) {
            return str_replace('{customerId}', $customerId, $template);
        }

        if (Str::endsWith($template, 'customer-top-ups')) {
            return Str::replaceLast('customer-top-ups', "customer/{$customerId}/top-ups", $template);
        }

        return rtrim($template, '/') . '/customer/' . $customerId . '/top-ups';
    }

    /**
     * Show the forgot password form.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);

        Mail::to($request->email)->send(new ResetPasswordMail($resetLink));

        return back()->with('success', 'Password reset link has been sent to your email address.');
    }

    /**
     * Show the reset password form.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Handle reset password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid password reset token.']);
        }

        if (!Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['email' => 'Invalid password reset token.']);
        }

        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        if (Carbon::now()->diffInHours($tokenCreatedAt) > 1) {
            return back()->withErrors(['email' => 'Password reset token has expired.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully. Please login with your new password.');
    }
}
