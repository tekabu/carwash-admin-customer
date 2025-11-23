<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $error = "";

        if (session('error')) {
            $error = "</br>".session('error');
        }

        return view('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function test()
    {
        $user = User::find(1);

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
