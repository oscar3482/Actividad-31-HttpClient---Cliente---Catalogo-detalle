<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerfilController extends Controller
{
    private $apiUrl = 'http://localhost:8001/api';

    // Ver perfil
    public function index()
    {
        $response = Http::withToken(session('token'))
            ->get("{$this->apiUrl}/perfil");

        if (!$response->successful()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $usuario = $response->json();
        return view('pages.perfil', compact('usuario'));
    }

    // Actualizar datos generales
    public function actualizarDatos(Request $request)
    {
        $response = Http::withToken(session('token'))
            ->put("{$this->apiUrl}/perfil", [
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        if ($response->successful()) {
            session(['user_name' => $request->name]);
            return redirect()->route('perfil')->with('success', 'Datos actualizados correctamente');
        }

        return back()->with('error', $response->json()['message'] ?? 'Error al actualizar');
    }

    // Actualizar imagen
    public function actualizarImagen(Request $request)
    {
        $request->validate(['foto' => 'required|image|mimes:jpg,jpeg,png|max:2048']);

        $response = Http::withToken(session('token'))
            ->attach('foto', file_get_contents($request->file('foto')), $request->file('foto')->getClientOriginalName())
            ->post("{$this->apiUrl}/perfil/imagen");

        if ($response->successful()) {
            return redirect()->route('perfil')->with('success', 'Imagen actualizada correctamente');
        }

        return back()->with('error', 'Error al actualizar imagen');
    }

    // Actualizar contraseña
    public function actualizarPassword(Request $request)
    {
        $response = Http::withToken(session('token'))
            ->put("{$this->apiUrl}/perfil/password", [
                'password_actual'          => $request->password_actual,
                'password_nuevo'           => $request->password_nuevo,
                'password_nuevo_confirmation' => $request->password_nuevo_confirmation,
            ]);

        if ($response->successful()) {
            return redirect()->route('perfil')->with('success', 'Contraseña actualizada correctamente');
        }

        return back()->with('error', $response->json()['error'] ?? 'Error al actualizar contraseña');
    }
}