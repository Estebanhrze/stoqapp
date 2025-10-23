@extends('layouts.admin')
@section('title','Historial de cambios')

@section('content')
<h1 class="h3 mb-4">Historial de cambios</h1>

{{-- Filtro solo por usuario --}}
<form method="GET" class="row g-2 mb-3">
  <div class="col-md-4">
    <input name="user" value="{{ request('user') }}" class="form-control" placeholder="Buscar por nombre de usuario">
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Filtrar</button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-striped table-sm align-middle">
    <thead class="table-light">
      <tr>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Acción</th>
        <th>Objeto</th>
        <th>IP</th>
      </tr>
    </thead>
    <tbody>
      @forelse($logs as $log)
      @php
  $props  = $log->properties ?? [];
  $nombre = optional($log->causer)->name ?? 'Sistema';

  $modelo = $log->subject_type ? class_basename($log->subject_type) : '—';
  $objeto = $modelo.'#'.($log->subject_id ?? '—');

  // Intentar obtener nombre del producto desde:
  // 1) el modelo cargado (si no fue borrado)
  // 2) 'attributes' (spatie: created/updated/deleted)
  // 3) 'old'/'new' (algunas versiones / casos)
  // 4) 'antes'/'despues' (nuestros logs manuales)
  // 5) 'eliminado' (si alguna vez lo usamos en delete manual)
  $nombreProducto =
      data_get($log->subject, 'nombre') ?:
      data_get($props, 'attributes.nombre') ?:
      data_get($props, 'old.nombre') ?:
      data_get($props, 'new.nombre') ?:
      data_get($props, 'despues.nombre') ?:
      data_get($props, 'antes.nombre') ?:
      data_get($props, 'eliminado.nombre');

  if ($nombreProducto) {
      $objeto .= ' — '.$nombreProducto;
  }
@endphp

        <tr>
          <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
          <td>{{ $nombre }}</td>
          <td>{{ ucfirst($log->description) }}</td>
          <td>{{ $objeto }}</td>
          <td class="text-muted small">{{ $props->get('ip','-') }}</td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted">Sin registros</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{ $logs->links('pagination::bootstrap-5') }}
@endsection
