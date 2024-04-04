<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'cache', callback: function (Blueprint $table): void {
            $table->string(column: 'key')->primary();
            $table->mediumText(column: 'value');
            $table->integer(column: 'expiration');
        });

        Schema::create(table: 'cache_locks', callback: function (Blueprint $table): void {
            $table->string(column: 'key')->primary();
            $table->string(column: 'owner');
            $table->integer(column: 'expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'cache');
        Schema::dropIfExists(table: 'cache_locks');
    }
};
