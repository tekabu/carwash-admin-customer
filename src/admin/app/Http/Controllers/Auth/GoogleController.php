<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;

use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $allowedDomains = explode(',', env('ALLOWED_EMAIL_DOMAIN'));

            if (!in_array(Str::afterLast($googleUser->email, '@'), $allowedDomains)) {
                return redirect(route('login.login'))->with('error', 'Invalid email address. Please contact support.');
            }
            
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt('12345'),
            ]);

            Auth::login($user);

            return redirect(route('dashboard'));
        } catch (\Exception $e) {
            # dd($e->getMessage());
            
            return redirect('/login');
        }
    }
}
