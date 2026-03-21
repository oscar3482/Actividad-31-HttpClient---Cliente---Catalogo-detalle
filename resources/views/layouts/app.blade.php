<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ElectroShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('inicio') }}"> ElectroShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
               <ul class="navbar-nav ms-auto align-items-center">
    <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}">Inicio</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('catalogo') }}">Catálogo</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>

    @if(session('token'))
    <li class="nav-item"><a class="nav-link" href="{{ route('perfil') }}"> Mi Perfil</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('pedidos') }}"> Mis Pedidos</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Salir ({{ session('user_name') }})</a></li>
@else
    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
@endif

    <li class="nav-item ms-3">
        <a class="btn btn-outline-light position-relative" href="{{ route('carrito') }}">
            🛒
            @php 
                $totalCarrito = array_sum(array_column(session()->get('carrito', []), 'cantidad')); 
            @endphp
            @if($totalCarrito > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $totalCarrito }}
            </span>
            @endif
        </a>
    </li>
</ul>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="container my-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© {{ date('Y') }} ElectroShop. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>