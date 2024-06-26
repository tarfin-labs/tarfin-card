<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'tarfin_cards', callback: static function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(model: User::class)->constrained();
            $table->unsignedBigInteger(column: 'number');
            $table->string(column: 'type');
            $table->dateTime(column: 'expiration_date');
            $table->dateTime(column: 'disabled_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'tarfin_cards');
    }
};
