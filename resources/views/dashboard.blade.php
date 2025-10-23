@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    $u = auth()->user();
    $role = $u->role ?? null;
    $branchName = optional($u->branch ?? null)->name ?? null;
    $isAdmin = ($role === 'admin');

    $products = \App\Models\Product::query()->latest()->get();

    $items      = $products->count();
    $stockTotal = $products->sum(fn($p) => (int)($p->stock ?? 0));
    $valorTotal = $products->sum(fn($p) => (int)($p->stock ?? 0) * (float)($p->costo ?? 0));

    // Umbral de bajo stock (puedes cambiarlo desde la URL: /dashboard?threshold=12)
    $threshold  = (int) request('threshold', 20);

    $recientes = $products->take(8);

    $bajoStock  = $products->filter(fn($p) => (int)($p->stock ?? 0) < $threshold)->count();

    $topStock = $products->sortByDesc(fn($p) => (int)($p->stock ?? 0))->take(10)->values();
    $topStockLabels = $topStock->map(fn($p) => Str::limit($p->nombre ?? ('#'.$p->id), 18));
    $topStockData   = $topStock->map(fn($p) => (int)($p->stock ?? 0));

    $topValor = $products->sortByDesc(fn($p) => (int)($p->stock ?? 0) * (float)($p->costo ?? 0))->take(10)->values();
    $topValorLabels = $topValor->map(fn($p) => Str::limit($p->nombre ?? ('#'.$p->id), 18));
    $topValorData   = $topValor->map(fn($p) => (int)($p->stock ?? 0) * (float)($p->costo ?? 0));

    $days = collect(range(0,6))->map(fn($i) => Carbon::now()->subDays(6-$i)->startOfDay());
    $createdLabels = $days->map(fn($d) => $d->format('d M'));
    $createdCounts = $days->map(fn($d) => $products->filter(fn($p) => optional($p->created_at)->isSameDay($d))->count());

    $okCount  = max($items - $bajoStock, 0);
    $lowCount = $bajoStock;

    // 🔽🔽🔽  DEFINIMOS LA LISTA DE BAJO STOCK  🔽🔽🔽
    $lowList = $products
        ->filter(fn($p) => (int)($p->stock ?? 0) < $threshold)
        ->sortBy(fn($p) => (int)($p->stock ?? 0)) // primero los más críticos
        ->values();
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3 mb-0">
    Dashboard
    @if($isAdmin)
      <span class="badge bg-dark ms-2">Admin — Todas las sucursales</span>
    @elseif($branchName)
      <span class="badge bg-secondary ms-2">Sucursal: {{ $branchName }}</span>
    @endif
  </h1>
</div>

<div class="row g-3">
  <div class="col-md-3"><div class="card shadow-sm h-100"><div class="card-body">
    <div class="text-muted small">Productos</div>
    <div class="display-6 fw-semibold">{{ $items }}</div>
  </div></div></div>
  <div class="col-md-3"><div class="card shadow-sm h-100"><div class="card-body">
    <div class="text-muted small">{{ $isAdmin ? 'Stock total (global)' : 'Stock total' }}</div>
    <div class="display-6 fw-semibold">{{ $stockTotal }}</div>
  </div></div></div>
  <div class="col-md-3"><div class="card shadow-sm h-100"><div class="card-body">
    <div class="text-muted small">Valor inventario (estimado)</div>
    <div class="display-6 fw-semibold">${{ number_format($valorTotal,2) }}</div>
    <div class="small text-muted">= stock × costo</div>
  </div></div></div>
  <div class="col-md-3"><div class="card shadow-sm h-100"><div class="card-body">
    <div class="text-muted small">Bajo stock (&lt; {{ $threshold }})</div>
    <div class="display-6 fw-semibold {{ $bajoStock>0 ? 'text-danger' : '' }}">{{ $bajoStock }}</div>
  </div></div></div>
</div>

<div class="row g-4 mt-1">
  <div class="col-lg-8"><div class="card shadow-sm h-100"><div class="card-body">
    <h5 class="card-title mb-3">Top productos por stock</h5>
    @if($topStock->isEmpty()) <div class="text-muted small">No hay datos suficientes.</div>
    @else <canvas id="chartTopStock" height="120"></canvas> @endif
  </div></div></div>

  <div class="col-lg-4"><div class="card shadow-sm h-100"><div class="card-body">
    <h5 class="card-title mb-3">Estado de stock</h5>
    @if($items === 0) <div class="text-muted small">No hay productos.</div>
    @else <canvas id="chartDonut" height="120"></canvas>
      <div class="form-text mt-2">OK: stock ≥ {{ $threshold }} | Bajo: stock &lt; {{ $threshold }}</div>
    @endif
  </div></div></div>
</div>

<div class="row g-4 mt-1">
  <div class="col-lg-8"><div class="card shadow-sm h-100"><div class="card-body">
    <h5 class="card-title mb-3">Top por valor (stock×costo)</h5>
    @if($topValor->isEmpty()) <div class="text-muted small">No hay datos suficientes.</div>
    @else <canvas id="chartTopValor" height="120"></canvas> @endif
  </div></div></div>

  <div class="col-lg-4"><div class="card shadow-sm h-100"><div class="card-body">
    <h5 class="card-title mb-3">Productos creados (últimos 7 días)</h5>
    <canvas id="chartCreated" height="120"></canvas>
  </div></div></div>
</div>

{{-- === Productos con bajo stock (lista) === --}}
<div class="card shadow-sm mt-4">
  <div class="card-body">
    <h5 class="card-title mb-3">
      Productos con bajo stock (&lt; {{ $threshold }})
      <span class="badge {{ $lowList->isEmpty() ? 'bg-success' : 'bg-danger' }} ms-2">
        {{ $lowList->count() }}
      </span>
    </h5>

    @if($lowList->isEmpty())
      <div class="text-muted small">No hay productos por debajo del umbral.</div>
    @else
      <div class="table-responsive">
        <table class="table table-sm align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Nombre</th>
              <th class="text-end">Stock</th>
              <th class="text-end">Costo</th>
              <th class="text-end">Valor (stock×costo)</th>
              <th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
          @foreach($lowList as $p)
            @php
              $stk  = (int)($p->stock ?? 0);
              $cost = (float)($p->costo ?? 0);
            @endphp
            <tr>
              <td>{{ $p->id }}</td>
              <td>{{ $p->codigo ?? '-' }}</td>
              <td class="text-truncate" style="max-width: 260px">{{ $p->nombre ?? '-' }}</td>
              <td class="text-end">
                <span class="badge {{ $stk === 0 ? 'bg-danger' : 'bg-warning text-dark' }}">{{ $stk }}</span>
              </td>
              <td class="text-end">${{ number_format($cost,2) }}</td>
              <td class="text-end">${{ number_format($stk * $cost,2) }}</td>
              <td class="text-end">
                @if(Route::has('products.edit'))
                  <a href="{{ route('products.edit', $p->id) }}" class="btn btn-outline-primary btn-sm">Reponer</a>
                @endif
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    @endif



  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const topStockLabels = @json($topStockLabels);
  const topStockData   = @json($topStockData);
  const donutData      = @json([$okCount, $lowCount]);
  const createdLabels  = @json($createdLabels);
  const createdCounts  = @json($createdCounts);
  const topValorLabels = @json($topValorLabels);
  const topValorData   = @json($topValorData);

  function makeChart(id, type, data, options={}) {
    const el = document.getElementById(id);
    if (!el) return;
    new Chart(el.getContext('2d'), { type, data, options });
  }
  makeChart('chartTopStock','bar',{labels:topStockLabels,datasets:[{label:'Unidades',data:topStockData}]},{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,ticks:{precision:0}}}});
  makeChart('chartDonut','doughnut',{labels:['OK','Bajo'],datasets:[{data:donutData}]},{responsive:true});
  makeChart('chartTopValor','bar',{labels:topValorLabels,datasets:[{label:'USD',data:topValorData}]},{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}});
  makeChart('chartCreated','line',{labels:createdLabels,datasets:[{label:'Nuevos',data:createdCounts,tension:0.3,fill:false}]},{responsive:true,scales:{y:{beginAtZero:true,ticks:{precision:0}}}});
</script>
@endpush
