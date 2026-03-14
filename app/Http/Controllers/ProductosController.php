<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductosController extends Controller
{
    private $apiUrl = 'http://localhost:8001/api';

    public function index()
    {
        try {
            $response = Http::get("{$this->apiUrl}/productos");
            $productos = $response->json();
        } catch (\Exception $e) {
            $productos = [];
        }

        return view('pages.catalogo', compact('productos'));
    }

    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/productos/{$id}");
            $producto = $response->json();
        } catch (\Exception $e) {
            $producto = null;
        }

        return view('pages.detalle', compact('producto'));
    }
}