@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
<h1 class="fw-bold mb-4">🛒 Mi Carrito</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(empty($carrito))
    <div class="alert alert-warning">Tu carrito está vacío. <a href="{{ route('catalogo') }}">Ver productos</a></div>
@else

{{-- Tabla de productos --}}
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($carrito as $item)
            @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
            <tr>
                <td style="width: 100px">
                    <img src="{{ $item['imagen'] }}" class="img-fluid rounded" style="height:70px; object-fit:cover;">
                </td>
                <td>{{ $item['nombre'] }}</td>
                <td>${{ number_format($item['precio'], 2) }}</td>
                <td style="width: 180px">
                    <form action="{{ route('carrito.actualizar', $item['id']) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control">
                        <button type="submit" class="btn btn-sm btn-primary">✔</button>
                    </form>
                </td>
                <td>${{ number_format($subtotal, 2) }}</td>
                <td>
                    <a href="{{ route('carrito.eliminar', $item['id']) }}" class="btn btn-sm btn-danger"
                       onclick="return confirm('¿Eliminar producto?')">🗑 Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end fw-bold">Total:</td>
                <td colspan="2" class="fw-bold text-success fs-5">${{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

{{-- Botones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('catalogo') }}" class="btn btn-outline-dark">← Seguir comprando</a>
    <div class="d-flex gap-2">
        <a href="{{ route('carrito.vaciar') }}" class="btn btn-danger"
           onclick="return confirm('¿Vaciar todo el carrito?')">🗑 Vaciar carrito</a>
        @if(session('token'))
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success"
                        onclick="return confirm('¿Confirmar pedido?')">
                    Finalizar compra
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-success">
                Inicia sesión para comprar
            </a>
        @endif
    </div>
</div>

@endif
@endsection