@extends('layouts.app')

@section('title','Soluciones | STOQ')

@section('content')
  {{-- HERO --}}
  <section class="bg-gradient-to-b from-white to-indigo-50/60">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-14 lg:py-20 grid lg:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-5">
          Todo lo que necesitas para dominar tu inventario
        </h1>
        <p class="text-gray-600 text-lg leading-relaxed mb-8">
          STOQ centraliza tu catálogo, movimientos y reportes en una plataforma simple y segura.
          Reduce quiebres, optimiza compras y toma decisiones con datos en tiempo real.
        </p>
        <div class="flex gap-3">
          <a href="{{ route('contact') }}"
             class="inline-flex items-center px-5 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-500 transition">
            Solicitar demo
          </a>
          <a href="{{ route('landing') }}"
             class="inline-flex items-center px-5 py-3 rounded-full border font-semibold text-gray-700 hover:text-indigo-600 hover:border-indigo-300 transition">
            Ver más
          </a>
        </div>
      </div>

      {{-- Imagen hero (usa local si la tienes) --}}
      <div class="order-first lg:order-last">
        <div class="relative overflow-hidden rounded-3xl shadow-xl ring-1 ring-black/5">
          <img
            src="{{ asset('img/solutions-hero.jpg') }}"
            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1600&auto=format&fit=crop';"
            alt="Panel de control de inventario"
            class="w-full h-72 md:h-96 object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
        </div>
      </div>
    </div>
  </section>

 {{-- FEATURES (grid con imagen pequeña a la derecha) --}}
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Lo que obtienes</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @php
        $features = [
          [
            'title' => 'Gestión de productos',
            'desc'  => 'Administra tu catálogo, variantes, SKUs y precios por lista con total control.',
            'img'   => 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?q=80&w=400&auto=format&fit=crop'
          ],
          [
            'title' => 'Movimientos',
            'desc'  => 'Registra entradas, salidas, ajustes y transferencias de forma ágil y segura.',
            'img'   => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=400&auto=format&fit=crop'
          ],
          
          [
            'title' => 'Reportes y analítica',
            'desc'  => 'Visualiza rotación, valorización, kardex y márgenes en tiempo real.',
            'img'   => 'https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=400&auto=format&fit=crop'
          ],
          [
            'title' => 'Multiusuario y roles',
            'desc'  => 'Define permisos y responsabilidades por área, con trazabilidad completa.',
            'img'   => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=400&auto=format&fit=crop'
          ],
       
        ];
      @endphp

      @foreach ($features as $f)
        <div class="flex items-center justify-between bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition">
          <div class="flex-1 pr-4">
            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $f['title'] }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $f['desc'] }}</p>
          </div>
          <div class="flex-shrink-0">
            <div class="w-20 h-20 overflow-hidden rounded-xl shadow-sm">
              <img src="{{ $f['img'] }}" alt="{{ $f['title'] }}" class="w-full h-full object-cover">
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

  {{-- CÓMO FUNCIONA --}}
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-8">Cómo funciona</h2>
      <ol class="grid md:grid-cols-3 gap-6 list-none counter-reset">
        @foreach ([
          ['title' => '1. Configura tu catálogo', 'desc' => 'Importa productos, define SKUs, unidades y stock mínimo.'],
          ['title' => '2. Registra movimientos', 'desc' => 'Entradas por compras, salidas por ventas y ajustes controlados.'],
          ['title' => '3. Analiza y decide', 'desc' => 'Reportes y alertas para comprar mejor y evitar quiebres.'],
        ] as $step)
          <li class="bg-white rounded-2xl p-6 shadow-sm">
            <p class="text-sm font-semibold text-indigo-600 mb-1">{{ $step['title'] }}</p>
            <p class="text-gray-600">{{ $step['desc'] }}</p>
          </li>
        @endforeach
      </ol>
      <div class="mt-10">
        <a href="{{ route('register') }}"
           class="inline-flex items-center px-6 py-3 rounded-full bg-gray-900 text-white font-semibold hover:bg-gray-800 transition">
          Empezar gratis
        </a>
      </div>
    </div>
  </section>
@endsection
