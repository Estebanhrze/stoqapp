@extends('layouts.admin')

@section('title', 'Crear producto')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">
    <h5 class="mb-0">Crear producto</h5>
  </div>

  <div class="card-body">
    <form action="{{ route('products.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Código</label>
        <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Costo</label>
        <input type="number" step="0.01" name="costo" value="{{ old('costo') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" required>
      </div>

      <div class="d-flex justify-content-end">
        <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
@endsection
