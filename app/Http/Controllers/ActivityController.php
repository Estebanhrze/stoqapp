<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index(Request $r)
{
    $q = Activity::query()->with(['causer', 'subject'])->latest();

    // Filtro por usuario (nombre o ID)
    if ($r->filled('user')) {
        $term = trim($r->input('user'));
        $q->where(function ($sub) use ($term) {
            $sub->where('causer_id', $term)
                ->orWhereHas('causer', function ($cq) use ($term) {
                    $cq->where('name', 'like', "%{$term}%");
                });
        });
    }

    $logs = $q->paginate(20)->withQueryString();

    return view('activity.index', compact('logs'));
}
}
