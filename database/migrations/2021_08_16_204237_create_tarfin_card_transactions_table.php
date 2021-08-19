<?php

use App\Models\TarfinCard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarfinCardTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tarfin_card_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TarfinCard::class);
            $table->unsignedBigInteger('amount');
            $table->string('currency_code');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tarfin_card_transactions');
    }
}
