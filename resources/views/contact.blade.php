@extends('layouts.app')
@section('title','Contactos | STOQ')
@section('content')
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">Contáctanos</h1>
    <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
      Agenda una demo o escríbenos y te ayudamos a digitalizar tu control de inventario.
    </p>
    <a href="mailto:contacto@stoq.com"
       class="inline-block bg-indigo-600 text-white font-semibold px-8 py-3 rounded-full shadow-md hover:bg-indigo-500 transition">
       contacto@stoq.com
    </a>
  </div>
</section>
@endsection
