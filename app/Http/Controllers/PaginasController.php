<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasController extends Controller
{
    public function inicio()
    {
        return view('pages.inicio');
    }

    public function nosotros()
    {
        return view('pages.nosotros');
    }

    public function contacto()
    {
        return view('pages.contacto');
    }
}