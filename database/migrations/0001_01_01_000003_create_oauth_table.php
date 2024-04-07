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
        Schema::create(table: 'oauth_auth_codes', callback: function (Blueprint $table): void {
            $table->string(column: 'id', length: 100)->primary();
            $table->unsignedBigInteger(column: 'user_id')->index();
            $table->uuid(column: 'client_id');
            $table->text(column: 'scopes')->nullable();
            $table->boolean(column: 'revoked');
            $table->dateTime(column: 'expires_at')->nullable();
        });

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

        Schema::create(table: 'oauth_refresh_tokens', callback: function (Blueprint $table): void {
            $table->string(column: 'id', length: 100)->primary();
            $table->string(column: 'access_token_id', length: 100)->index();
            $table->boolean(column: 'revoked');
            $table->dateTime(column: 'expires_at')->nullable();
        });

        Schema::create(table: 'oauth_personal_access_clients', callback: function (Blueprint $table): void {
            $table->bigIncrements(column: 'id');
            $table->uuid(column: 'client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'oauth_auth_codes');
        Schema::dropIfExists(table: 'oauth_access_tokens');
        Schema::dropIfExists(table: 'oauth_clients');
        Schema::dropIfExists(table: 'oauth_refresh_tokens');
        Schema::dropIfExists(table: 'oauth_personal_access_clients');
    }
};