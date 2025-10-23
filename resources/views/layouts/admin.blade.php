<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','STOQ')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @stack('head')
</head>
<body>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('landing') }}">STOQ</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
  <li class="nav-item me-3">
    <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
  </li>

  @auth
    <li class="nav-item me-3">
      <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
    </li>
      <li class="nav-item me-3">
    <a class="nav-link" href="{{ route('activity.index') }}">Historial</a>
  </li>
    <li class="nav-item">
      <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
        @csrf
        <button class="btn btn-outline-light btn-sm d-flex align-items-center px-3 py-1">Salir</button>
      </form>
    </li>
  @endauth
</ul>

    </div>
  </div>
</nav>


  <main class="container my-5">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
