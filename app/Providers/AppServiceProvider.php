<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    Activity::saving(function (Activity $activity) {
        // agrega IP y user agent a cualquier log (automático o manual)
        $props = collect($activity->properties ?? []);
        $activity->properties = $props->merge([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    });
}
}
