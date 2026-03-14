<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Ver carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('pages.carrito', compact('carrito'));
    }

    // Agregar producto
    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $id = $request->id;

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'id'       => $request->id,
                'nombre'   => $request->nombre,
                'precio'   => $request->precio,
                'imagen'   => $request->imagen,
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->route('carrito')->with('success', 'Producto agregado al carrito');
    }

    // Actualizar cantidad
    public function actualizar(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito')->with('success', 'Carrito actualizado');
    }

    // Eliminar producto
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito')->with('success', 'Producto eliminado');
    }

    // Vaciar carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito')->with('success', 'Carrito vaciado');
    }
}