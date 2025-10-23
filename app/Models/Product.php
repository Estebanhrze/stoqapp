<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    use LogsActivity;

    protected $fillable = ['codigo','nombre','costo','stock'];

    protected $casts = [
        'costo' => 'decimal:2',
        'stock' => 'integer',
    ];

    // === Activity Log (Spatie) ===
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('product')                      // nombre del log
            ->logOnly(['codigo','nombre','costo','stock']) // columnas a auditar
            ->logOnlyDirty()                             // solo si cambian
            ->dontSubmitEmptyLogs();                     // evita logs vacíos
    }

    public function scopeCosto(Builder $q, ?string $op, $valor): Builder
    {
        if ($op && $valor !== null && $valor !== '') {
            return $q->where('costo', $op, $valor);
        }
        return $q;
    }

    public function scopeStock(Builder $q, ?string $op, $valor): Builder
    {
        if ($op && $valor !== null && $valor !== '') {
            return $q->where('stock', $op, $valor);
        }
        return $q;
    }

    public function scopeOrden(Builder $q, ?string $campo, ?string $dir = 'asc'): Builder
    {
        $permitidos = ['id','codigo','nombre','costo','stock','created_at'];
        $campo = in_array($campo, $permitidos, true) ? $campo : 'costo';
        $dir   = ($dir === 'desc') ? 'desc' : 'asc';

        if ($campo === 'costo') {
            return $q->orderByRaw("CAST(costo AS DECIMAL(18,2)) {$dir}")
                     ->orderBy('id', 'asc');
        }

        return $q->orderBy($campo, $dir)->orderBy('id','asc');
    }
}
