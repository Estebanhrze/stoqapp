<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','STOQ')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-800">
    <div class="min-h-screen">
        {{-- Navbar de Breeze (si lo usas) --}}
        @includeIf('layouts.navigation')

        {{-- Cabecera opcional por sección --}}
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Contenido principal por secciones --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
