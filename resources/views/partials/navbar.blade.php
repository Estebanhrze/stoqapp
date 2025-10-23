<nav class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-100 z-50">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">

    <a href="{{ route('landing') }}" class="font-extrabold text-2xl tracking-tight">
      <span class="text-gray-900">ST</span><span class="text-indigo-600">OQ</span>
    </a>

    <div class="hidden md:flex items-center space-x-8 font-semibold text-gray-700">
      <a href="{{ route('landing') }}"   class="hover:text-indigo-600 transition">Inicio</a>
      <a href="{{ route('about') }}"     class="hover:text-indigo-600 transition">Nosotros</a>
      <a href="{{ route('solutions') }}" class="hover:text-indigo-600 transition">Soluciones</a>
      <a href="{{ route('contact') }}"   class="hover:text-indigo-600 transition">Contactos</a>
    </div>

    <div class="hidden md:flex items-center space-x-3">
      @guest
        <a href="{{ route('login') }}"    class="px-4 py-2 rounded-full font-semibold text-gray-700 hover:text-indigo-600">Login</a>
        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full font-bold bg-indigo-600 text-white hover:bg-indigo-500">Register</a>
      @endguest

      @auth
        <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full font-semibold text-gray-700 hover:text-indigo-600">Productos</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button class="px-4 py-2 rounded-full font-semibold text-white bg-gray-800 hover:bg-gray-700">
            Logout
          </button>
        </form>
      @endauth
    </div>

    {{-- Botón móvil opcional … (omítelo si no lo necesitas) --}}
  </div>
</nav>
