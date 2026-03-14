@extends('layouts.app')

@section('title', $producto['nombre'] ?? 'Detalle del Producto')

@section('content')
@if(!$producto)
    <div class="alert alert-danger">No se encontró el producto.</div>
@else
<div class="row">
    <div class="col-md-6">
        {{-- Imagen principal --}}
        <img src="{{ $producto['imagen1'] ?? 'https://via.placeholder.com/500x400' }}"
             class="img-fluid rounded shadow mb-3" alt="Imagen principal">

        {{-- 3 imágenes --}}
        <div class="row g-2">
            @foreach(['imagen1', 'imagen2', 'imagen3'] as $img)
            <div class="col-4">
                <img src="{{ $producto[$img] ?? 'https://via.placeholder.com/150' }}"
                     class="img-fluid rounded shadow-sm" alt="Imagen del producto">
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <h1 class="fw-bold">{{ $producto['nombre'] ?? 'Sin nombre' }}</h1>
        <p class="text-muted">{{ $producto['descripcion'] ?? '' }}</p>
        <h3 class="text-success">${{ number_format($producto['precio'] ?? 0, 2) }}</h3>
        <p class="mt-3">
            <span class="badge bg-secondary fs-6">
                Stock: {{ $producto['existencia'] ?? 'N/A' }} unidades
            </span>
        </p>
        <a href="{{ route('catalogo') }}" class="btn btn-outline-dark mt-3">← Volver al catálogo</a>
    </div>
</div>
@endif
@endsection