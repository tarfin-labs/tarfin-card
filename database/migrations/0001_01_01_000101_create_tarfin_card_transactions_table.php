<?php

declare(strict_types=1);

use App\Models\TarfinCard;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'tarfin_card_transactions', callback: function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(model: TarfinCard::class)->constrained();
            $table->unsignedBigInteger(column: 'amount');
            $table->string(column: 'currency_code');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'tarfin_card_transactions');
    }
};
