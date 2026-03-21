@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="text-center py-5">
    <h1 class="display-4 fw-bold">Bienvenido a ElectroShop </h1>
    <p class="lead text-muted">Encuentra los mejores productos al mejor precio.</p>
    <a href="{{ route('catalogo') }}" class="btn btn-dark btn-lg mt-3">Ver Catálogo</a>
</div>

<div class="row mt-5">
    <div class="col-md-4 text-center">
        <h3> Envío Rápido</h3>
        <p>Recibe tus productos en la puerta de tu casa.</p>
    </div>
    <div class="col-md-4 text-center">
        <h3> Calidad Garantizada</h3>
        <p>Todos nuestros productos pasan control de calidad.</p>
    </div>
    <div class="col-md-4 text-center">
        <h3> Pago Seguro</h3>
        <p>Tus datos siempre protegidos.</p>
    </div>
</div>
@endsection