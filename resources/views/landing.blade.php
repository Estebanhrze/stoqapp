@extends('layouts.app')

@section('title','STOQ | Gestión Inteligente de Inventario')

@section('content')

  {{-- Hero --}}
  <section class="bg-gradient-to-b from-white to-indigo-50 rounded-b-3xl">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 flex flex-col lg:flex-row items-center gap-10">
      <div class="flex-1">
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-5">
          Controla tu <span class="text-indigo-600">Inventario</span> con Precisión
        </h1>
        <p class="text-gray-600 text-lg mb-8 max-w-lg">
          STOQ es una plataforma para pequeñas y medianas empresas que desean optimizar
          el control de existencias, automatizar movimientos y tomar decisiones con datos reales.
        </p>
        <div class="flex gap-3">
          <a href="{{ route('register') }}" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-indigo-500 transition">
            Probar gratis
          </a>
          <a href="{{ route('solutions') }}" class="font-semibold px-6 py-3 rounded-full border border-gray-300 hover:border-indigo-400 hover:text-indigo-600 transition">
            Ver soluciones
          </a>
        </div>
      </div>

      <div class="flex-1">
        <div class="bg-white shadow-xl rounded-3xl p-6">
          <img src="https://images.unsplash.com/photo-1557825835-70d97c4aa567?q=80&w=1200&auto=format&fit=crop"
               alt="Panel de control de inventario" class="rounded-2xl">
        </div>
      </div>
    </div>
  </section>

{{-- Beneficios resumen --}}
{{-- Mantiene py-20, pero cambia bg-white por un degradado suave --}}
<section class="py-20" style="background-image: linear-gradient(to top, #f8fafc, #ffffff);"> 
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Título mantiene el tamaño y espaciado original (mb-10), pero con acento de color --}}
        <h2 class="text-3xl font-bold mb-10 text-gray-900 text-center">
            ¿Por qué <span class="text-indigo-600">STOQ</span>?
        </h2>
        
        {{-- Mantiene gap-8 --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Tarjeta 1: Stock en tiempo real --}}
            {{-- Mantiene p-8, rounded-2xl. Mejora shadow y añade color en el hover y línea superior --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 relative overflow-hidden group">
                
                {{-- Toque de color: Línea superior con degradado (Estético) --}}
                <div class="absolute top-0 left-0 w-full h-1" style="background-image: linear-gradient(to right, #6366f1, #8b5cf6);"></div>
                
                {{-- Placeholder de Ícono con color --}}
                <div class="mb-3 text-indigo-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z"></path></svg>
                </div>

                <h3 class="text-xl font-bold mb-2 text-gray-900">Stock en tiempo real</h3>
                <p class="text-gray-600">Registra entradas y salidas con un clic y visualiza existencias actualizadas.</p>
            </div>
            
            {{-- Tarjeta 2: Reportes inteligentes --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 relative overflow-hidden group">
                
                {{-- Toque de color: Línea superior con degradado (Estético) --}}
                <div class="absolute top-0 left-0 w-full h-1" style="background-image: linear-gradient(to right, #6366f1, #8b5cf6);"></div>

                {{-- Placeholder de Ícono con color --}}
                <div class="mb-3 text-indigo-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                </div>

                <h3 class="text-xl font-bold mb-2 text-gray-900">Reportes inteligentes</h3>
                <p class="text-gray-600">Analiza y crea alertas de agotamiento de inventario.</p>
            </div>
            
            {{-- Tarjeta 3: Listo para crecer --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 relative overflow-hidden group">
                
                {{-- Toque de color: Línea superior con degradado (Estético) --}}
                <div class="absolute top-0 left-0 w-full h-1" style="background-image: linear-gradient(to right, #6366f1, #8b5cf6);"></div>

                {{-- Placeholder de Ícono con color --}}
                <div class="mb-3 text-indigo-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>

                <h3 class="text-xl font-bold mb-2 text-gray-900">Listo para crecer</h3>
                <p class="text-gray-600">Multiusuario, roles y API para integrarte con ventas y facturación.</p>
            </div>
            
        </div>
    </div>
</section>
@endsection