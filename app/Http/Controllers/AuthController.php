<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // MUESTRA EL FORMULARIO DE REGISTRO
    public function registerForm()
    {
        return view('register');
    }

    // GUARDA EL USUARIO EN LA BD
    public function register(Request $request)
    {
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            // AQUÍ SE ENCRIPTA LA CONTRASEÑA
            'password' => Hash::make($request->password),
            'rol' => 'user',
        ]);

        return redirect('/login');
    }

    // MUESTRA EL FORMULARIO DE LOGIN
    public function loginForm()
    {
        return view('login');
    }

    // HACE EL LOGIN
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect('/dashboard');
        }

        return back();
    }

    // CIERRA SESIÓN
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

