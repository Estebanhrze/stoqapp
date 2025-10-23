@extends('layouts.admin')
@section('title','Productos')
@section('content')
  @php
    $u = auth()->user();
    $role = $u->role ?? null;
    $branchId = $u->branch_id ?? null;
    $branchName = optional($u->branch ?? null)->name ?? null;
    $isAdmin = ($role === 'admin');
  @endphp

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
      Productos
      @if($isAdmin)
        <span class="badge bg-dark ms-2">Admin — Todas las sucursales</span>
      @elseif($branchName)
        <span class="badge bg-secondary ms-2">Sucursal: {{ $branchName }}</span>
      @endif
    </h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Agregar</a>
  </div>

  {{-- Filtros --}}
  <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end mb-4">
    <div class="col-md-6">
      <label class="form-label">Buscar</label>
      <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Código o nombre">
    </div>
    <div class="col-md-3">
      <label class="form-label">Orden por Costo</label>
<select name="orden_dir" class="form-select">
   <option value="asc"  @selected(request('orden_dir')==='asc')>Ascendente</option>
<option value="desc" @selected(request('orden_dir')==='desc')>Descendente</option>

      </select>
    </div>
    <div class="col-md-3">
      <button class="btn btn-outline-secondary w-100">Filtrar</button>
    </div>
  </form>

  {{-- Tabla --}}
  <table class="table table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Costo</th>
        <th>
          {{-- Etiqueta de stock dependiente del rol (si no hay rol, queda "Stock") --}}
          @if($isAdmin) Stock (Total) @else Stock (Mi sucursal) @endif
        </th>
        <th>Creado</th>
        <th class="text-end">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $product)
        @php
          // Si mañana cargas ->with('inventories'), este bloque leerá multi-sucursal.
          $hasInventoriesRelation = method_exists($product, 'inventories') && $product->relationLoaded('inventories');
        @endphp
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->codigo }}</td>
          <td>{{ $product->nombre }}</td>
          <td>${{ number_format($product->costo, 2) }}</td>
          <td>
            @if($hasInventoriesRelation)
              @if($isAdmin)
                {{ $product->inventories->sum('stock') }}
              @else
                {{ optional($product->inventories->firstWhere('branch_id', $branchId))->stock ?? 0 }}
              @endif
            @else
              {{-- Fallback al stock actual mientras no exista la relación --}}
              {{ $product->stock }}
            @endif
          </td>
          <td>{{ optional($product->created_at)->format('Y-m-d H:i') }}</td>
          <td class="text-end">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center text-muted">Sin registros</td></tr>
      @endforelse
    </tbody>
  </table>
{{ $products->links('pagination::bootstrap-5') }}

@endsection
