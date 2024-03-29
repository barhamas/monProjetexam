<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $redirectToAdmin = '/administrateurs/dashboard';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Authentification en tant qu'administrateur
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended($this->redirectToAdmin);
            //return redirect()->intended('/administrateurs/dashboard');

        }



        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        // Déconnexion de l'administrateur
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }


        // Rediriger vers la page de connexion
        return redirect('/principal');
    }
}
