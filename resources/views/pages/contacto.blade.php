@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="fw-bold mb-4">Contáctanos</h1>
        <p class="text-muted">¿Tienes alguna pregunta? Escríbenos.</p>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Tu nombre">
        </div>
        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" placeholder="correo@ejemplo.com">
        </div>
        <div class="mb-3">
            <label class="form-label">Mensaje</label>
            <textarea class="form-control" rows="5" placeholder="Escribe tu mensaje aquí..."></textarea>
        </div>
        <button class="btn btn-dark w-100">Enviar mensaje</button>

        <hr class="my-4">
        <p>contacto@mitienda.com</p>
        <p>+52 33 1234 5678</p>
        <p>Guadalajara, Jalisco, México</p>
    </div>
</div>
@endsection