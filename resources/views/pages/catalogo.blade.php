@extends('layouts.app')

@section('title', 'Catálogo')

@section('content')
<h1 class="fw-bold mb-4">Catálogo de Productos</h1>

@if(empty($productos))
    <div class="alert alert-warning">No se pudieron cargar los productos. Verifica la API.</div>
@else
<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($productos as $producto)
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="{{ $producto['imagen1'] ?? 'https://via.placeholder.com/300x200' }}"
                 class="card-img-top"
                 alt="{{ $producto['nombre'] ?? 'Producto' }}"
                 style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $producto['nombre'] ?? 'Sin nombre' }}</h5>
                <p class="card-text text-muted">{{ Str::limit($producto['descripcion'] ?? '', 80) }}</p>
                <p class="fw-bold text-success fs-5">${{ number_format($producto['precio'] ?? 0, 2) }}</p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('producto.detalle', $producto['id']) }}" class="btn btn-dark w-100">Ver detalle</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection