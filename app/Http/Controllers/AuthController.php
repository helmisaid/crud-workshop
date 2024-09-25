<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function indexlogin()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function indexregister()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'id_jenis_user' => '2',
        ]);

        return redirect('login')->with('success', 'Registrasi berhasil! Anda sekarang dapat login.');
    }
}
