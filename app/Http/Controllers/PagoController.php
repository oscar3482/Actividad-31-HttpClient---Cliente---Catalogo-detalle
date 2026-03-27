<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagoController extends Controller
{
    private $apiUrl = 'http://localhost:8001/api';

    public function iniciarPago($id)
    {
        $response = Http::withToken(session('token'))
            ->post("{$this->apiUrl}/pagos/{$id}/iniciar");

        if ($response->successful()) {
            $data = $response->json();
            return redirect($data['approval_url']);
        }

        return redirect()->route('pedidos')
            ->with('error', $response->json()['error'] ?? 'Error al iniciar el pago');
    }
}