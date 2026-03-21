<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PedidoController extends Controller
{
    private $apiUrl = 'http://localhost:8001/api';

    public function index()
    {
        $response = Http::withToken(session('token'))
            ->get("{$this->apiUrl}/pedidos");

        $pedidos = $response->successful() ? $response->json() : [];

        return view('pages.pedidos', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'El carrito está vacío');
        }

        $productos = [];
        foreach ($carrito as $item) {
            $productos[] = [
                'producto_id'     => $item['id'],
                'nombre_producto' => $item['nombre'],
                'precio'          => $item['precio'],
                'cantidad'        => $item['cantidad'],
            ];
        }

        $response = Http::withToken(session('token'))
            ->post("{$this->apiUrl}/pedidos", [
                'productos' => $productos
            ]);

        if ($response->successful()) {
            session()->forget('carrito');
            return redirect()->route('pedidos')->with('success', '¡Pedido creado correctamente!');
        }

        return redirect()->route('carrito')->with('error', $response->json()['error'] ?? 'Error al crear el pedido');
    }

    public function show($id)
    {
        $response = Http::withToken(session('token'))
            ->get("{$this->apiUrl}/pedidos/{$id}");

        if (!$response->successful()) {
            return redirect()->route('pedidos')->with('error', 'Pedido no encontrado');
        }

        $pedido = $response->json();
        return view('pages.detalle-pedido', compact('pedido'));
    }

    public function cancelar($id)
    {
        $response = Http::withToken(session('token'))
            ->put("{$this->apiUrl}/pedidos/{$id}/cancelar");

        if ($response->successful()) {
            return redirect()->route('pedidos')->with('success', 'Pedido cancelado correctamente');
        }

        return redirect()->route('pedidos')->with('error', $response->json()['error'] ?? 'Error al cancelar');
    }
}