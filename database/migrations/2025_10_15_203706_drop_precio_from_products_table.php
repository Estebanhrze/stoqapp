<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('products', 'precio')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('precio');
            });
        }
    }
    public function down(): void
    {
        if (!Schema::hasColumn('products', 'precio')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('precio', 10, 2)->nullable();
            });
        }
    }
};
