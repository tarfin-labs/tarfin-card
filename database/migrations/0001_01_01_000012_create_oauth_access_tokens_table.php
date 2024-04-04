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
        Schema::create(table: 'oauth_access_tokens', callback: function (Blueprint $table): void {
            $table->string(column: 'id', length: 100)->primary();
            $table->unsignedBigInteger(column: 'user_id')->nullable()->index();
            $table->uuid(column: 'client_id');
            $table->string(column: 'name')->nullable();
            $table->text(column: 'scopes')->nullable();
            $table->boolean(column: 'revoked');
            $table->timestamps();
            $table->dateTime(column: 'expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'oauth_access_tokens');
    }
};
