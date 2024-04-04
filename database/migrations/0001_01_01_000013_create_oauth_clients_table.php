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
        Schema::create(table: 'oauth_clients', callback: function (Blueprint $table): void {
            $table->uuid(column: 'id')->primary();
            $table->unsignedBigInteger(column: 'user_id')->nullable()->index();
            $table->string(column: 'name');
            $table->string(column: 'secret', length: 100)->nullable();
            $table->string(column: 'provider')->nullable();
            $table->text(column: 'redirect');
            $table->boolean(column: 'personal_access_client');
            $table->boolean(column: 'password_client');
            $table->boolean(column: 'revoked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'oauth_clients');
    }
};
