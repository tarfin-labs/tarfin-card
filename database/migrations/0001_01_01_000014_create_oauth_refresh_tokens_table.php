<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'oauth_refresh_tokens', callback: function (Blueprint $table): void {
            $table->string(column: 'id', length: 100)->primary();
            $table->string(column: 'access_token_id', length: 100)->index();
            $table->boolean(column: 'revoked');
            $table->dateTime(column: 'expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'oauth_refresh_tokens');
    }
};
