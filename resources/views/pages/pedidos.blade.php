@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')
<h1 class="fw-bold mb-4">Mis Pedidos</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(request('success'))
    <div class="alert alert-success">{{ request('success') }}</div>
@endif
@if(request('error'))
    <div class="alert alert-danger">{{ request('error') }}</div>
@endif

@if(empty($pedidos))
    <div class="alert alert-warning">
        No tienes pedidos aún. <a href="{{ route('catalogo') }}">Ver productos</a>
    </div>
@else
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th># Pedido</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>#{{ $pedido['id'] }}</td>
                <td>{{ \Carbon\Carbon::parse($pedido['created_at'])->format('d/m/Y H:i') }}</td>
                <td>
                    @if($pedido['estado'] === 'pendiente')
                        <span class="badge bg-success">Pendiente</span>
                    @else
                        <span class="badge bg-danger">Cancelado</span>
                    @endif
                </td>
                <td>${{ number_format($pedido['total'], 2) }}</td>
                <td class="d-flex gap-2">
                   <a href="{{ route('pedidos.show', $pedido['id']) }}" 
                    class="btn btn-sm btn-primary">Ver detalle</a>

                    @if($pedido['estado'] !== 'cancelado' && $pedido['estado_pago'] !== 'pagado')
                    <a href="{{ route('pedidos.pagar', $pedido['id']) }}"
                    class="btn btn-sm btn-success"
                    onclick="return confirm('¿Proceder al pago con PayPal?')">Pagar</a>
                    @endif

@if($pedido['estado_pago'] === 'pagado')
    <span class="badge bg-success">Pagado</span>
@endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection