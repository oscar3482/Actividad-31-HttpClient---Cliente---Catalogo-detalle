@extends('layouts.app')

@section('title', 'Detalle del Pedido')

@section('content')
<h1 class="fw-bold mb-4">Detalle del Pedido #{{ $pedido['id'] }}</h1>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido['created_at'])->format('d/m/Y H:i') }}</p>
        <p><strong>Estado:</strong> 
            @if($pedido['estado'] === 'pendiente')
                <span class="badge bg-success">Pendiente</span>
            @else
                <span class="badge bg-danger">Cancelado</span>
            @endif
        </p>
        <p><strong>Total:</strong> <span class="text-success fw-bold">${{ number_format($pedido['total'], 2) }}</span></p>
    </div>
</div>

<h4 class="fw-bold mb-3">Productos del pedido</h4>
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido['detalles'] as $detalle)
            <tr>
                <td>{{ $detalle['nombre_producto'] }}</td>
                <td>${{ number_format($detalle['precio'], 2) }}</td>
                <td>{{ $detalle['cantidad'] }}</td>
                <td>${{ number_format($detalle['subtotal'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end fw-bold">Total:</td>
                <td class="fw-bold text-success">${{ number_format($pedido['total'], 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('pedidos') }}" class="btn btn-outline-dark">← Volver a mis pedidos</a>
    @if($pedido['estado'] === 'pendiente')
        <a href="{{ route('pedidos.cancelar', $pedido['id']) }}"
           class="btn btn-danger"
           onclick="return confirm('¿Cancelar este pedido?')">🗑 Cancelar pedido</a>
    @endif
</div>
@endsection