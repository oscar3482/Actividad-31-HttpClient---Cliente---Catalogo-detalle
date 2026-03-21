<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $apiUrl = 'http://localhost:8001/api';

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $response = Http::post("{$this->apiUrl}/login", [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session([
                'token'   => $data['token'],
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
            ]);
            return redirect()->route('inicio')->with('success', '¡Bienvenido ' . $data['user']['name'] . '!');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function register(Request $request)
    {
        $response = Http::post("{$this->apiUrl}/register", [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session([
                'token'   => $data['token'],
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
            ]);
            return redirect()->route('inicio')->with('success', '¡Registro exitoso! Bienvenido ' . $data['user']['name'] . '!');
        }

        return back()->with('error', 'Error al registrarse. Intenta con otro correo.');
    }

    public function logout(Request $request)
    {
        Http::withToken(session('token'))->post("{$this->apiUrl}/logout");
        session()->forget(['token', 'user_id', 'user_name', 'carrito']);
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}