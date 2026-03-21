@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<h1 class="fw-bold mb-4"> Mi Perfil</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row g-4">

    {{-- Foto de perfil --}}
    <div class="col-md-4 text-center">
        <div class="card shadow p-3">
            <img src="{{ $usuario['foto'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($usuario['name']) . '&size=150&background=343a40&color=fff' }}"
                 class="rounded-circle mx-auto d-block mb-3"
                 style="width:150px; height:150px; object-fit:cover;">
            <h5 class="fw-bold">{{ $usuario['name'] }}</h5>
            <p class="text-muted">{{ $usuario['email'] }}</p>
            <p class="text-muted"> {{ $usuario['phone'] ?? 'Sin teléfono' }}</p>

            {{-- Actualizar imagen --}}
            <form action="{{ route('perfil.imagen') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                </div>
                <button type="submit" class="btn btn-dark btn-sm w-100"> Actualizar foto</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">

        {{-- Datos generales --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3"> Datos Generales</h5>
                <form action="{{ route('perfil.datos') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $usuario['name'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ $usuario['email'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ $usuario['phone'] ?? '' }}"
                               placeholder="Ej: 33 1234 5678">
                    </div>
                    <button type="submit" class="btn btn-dark w-100"> Guardar cambios</button>
                </form>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="card shadow">
            <div class="card-body">
                <h5 class="fw-bold mb-3"> Cambiar Contraseña</h5>
                <form action="{{ route('perfil.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Contraseña actual</label>
                        <input type="password" name="password_actual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="password_nuevo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" name="password_nuevo_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100"> Actualizar contraseña</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection