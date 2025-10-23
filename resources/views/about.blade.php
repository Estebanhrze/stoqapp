@extends('layouts.app')

@section('title','Nosotros | STOQ')

@section('content')
  {{-- HERO --}}
  <section class="bg-gradient-to-b from-white to-indigo-50/60">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <p class="text-sm font-semibold text-indigo-600 tracking-wide uppercase mb-3">Quiénes somos</p>
        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6">
          Impulsamos la gestión de inventario<br class="hidden md:block"> de las PYMEs con tecnología simple.
        </h1>
        <p class="text-gray-600 text-lg leading-relaxed mb-8">
          En <span class="font-semibold text-gray-900">STOQ</span> ayudamos a PYMEs a profesionalizar su gestión de inventario con una
          plataforma <span class="font-medium">simple, segura y escalable</span>. Combinamos experiencia en logística, producto y desarrollo
          para entregar resultados reales y medibles.
        </p>

        <div class="flex gap-3">
          <a href="{{ route('solutions') }}"
             class="inline-flex items-center px-5 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-500 transition">
            Nuestras soluciones
          </a>
          <a href="{{ route('contact') }}"
             class="inline-flex items-center px-5 py-3 rounded-full border font-semibold text-gray-700 hover:text-indigo-600 hover:border-indigo-300 transition">
            Contáctanos
          </a>
        </div>
      </div>

      {{-- Imagen destacada --}}
      <div class="order-first lg:order-last">
        <div class="relative">
          <img
  src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1600&auto=format&fit=crop"
  alt="Equipo trabajando con dashboard"
  class="rounded-3xl shadow-xl ring-1 ring-black/5 w-full object-cover max-h-[480px]">

          <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-lg p-4 hidden md:flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">24/7</div>
            <div class="text-sm">
              <p class="font-semibold text-gray-900">Soporte dedicado</p>
              <p class="text-gray-500">Acompañamiento continuo</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- MÉTRICAS --}}
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <dl class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
          <dt class="text-sm text-gray-500">Productos gestionados</dt>
          <dd class="mt-1 text-3xl font-extrabold text-gray-900">+120K</dd>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
          <dt class="text-sm text-gray-500">Ahorro promedio</dt>
          <dd class="mt-1 text-3xl font-extrabold text-gray-900">18%</dd>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
          <dt class="text-sm text-gray-500">Tiendas activas</dt>
          <dd class="mt-1 text-3xl font-extrabold text-gray-900">350+</dd>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
          <dt class="text-sm text-gray-500">Uptime</dt>
          <dd class="mt-1 text-3xl font-extrabold text-gray-900">99.9%</dd>
        </div>
      </dl>
    </div>
  </section>

  {{-- VALORES / DIFERENCIADORES --}}
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-8">Lo que nos diferencia</h2>
      <div class="grid md:grid-cols-3 gap-6">
        <div class="rounded-2xl border p-6 hover:shadow-md transition">
          <div class="text-indigo-600 font-bold text-sm uppercase mb-2">Implementación rápida</div>
          <p class="text-gray-600">Configura todo en poco tiempo y sin complicaciones.</p>
        </div>
        <div class="rounded-2xl border p-6 hover:shadow-md transition">
          <div class="text-indigo-600 font-bold text-sm uppercase mb-2">Decisiones con datos</div>
          <p class="text-gray-600">Conoce qué se vende, qué falta y cómo mejorar tus resultados.</p>
        </div>
        <div class="rounded-2xl border p-6 hover:shadow-md transition">
          <div class="text-indigo-600 font-bold text-sm uppercase mb-2">Crece con confianza</div>
          <p class="text-gray-600">Tu negocio evoluciona, y la plataforma te acompaña paso a paso.</p>
        </div>
      </div>
    </div>
  </section>
@endsection
