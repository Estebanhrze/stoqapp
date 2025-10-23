@extends('layouts.admin')

@section('title', 'Editar producto')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-warning text-dark">
    <h5 class="mb-0">Editar producto</h5>
  </div>

  <div class="card-body">
    <form action="{{ route('products.update', $product->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Código</label>
        <input type="text" name="codigo" value="{{ old('codigo', $product->codigo) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $product->nombre) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Costo</label>
        <input type="number" step="0.01" name="costo" value="{{ old('costo', $product->costo) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required>
      </div>

      <div class="d-flex justify-content-end">
        <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </form>
  </div>
</div>
@endsection
