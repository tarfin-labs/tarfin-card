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
        Schema::create(table: 'jobs', callback: function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'queue')->index();
            $table->longText(column: 'payload');
            $table->unsignedTinyInteger(column: 'attempts');
            $table->unsignedInteger(column: 'reserved_at')->nullable();
            $table->unsignedInteger(column: 'available_at');
            $table->unsignedInteger(column: 'created_at');
        });

        Schema::create(table: 'job_batches', callback: function (Blueprint $table): void {
            $table->string(column: 'id')->primary();
            $table->string(column: 'name');
            $table->integer(column: 'total_jobs');
            $table->integer(column: 'pending_jobs');
            $table->integer(column: 'failed_jobs');
            $table->longText(column: 'failed_job_ids');
            $table->mediumText(column: 'options')->nullable();
            $table->integer(column: 'cancelled_at')->nullable();
            $table->integer(column: 'created_at');
            $table->integer(column: 'finished_at')->nullable();
        });

        Schema::create(table: 'failed_jobs', callback: function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'uuid')->unique();
            $table->text(column: 'connection');
            $table->text(column: 'queue');
            $table->longText(column: 'payload');
            $table->longText(column: 'exception');
            $table->timestamp(column: 'failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'jobs');
        Schema::dropIfExists(table: 'job_batches');
        Schema::dropIfExists(table: 'failed_jobs');
    }
};
