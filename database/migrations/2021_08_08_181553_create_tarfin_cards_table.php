<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarfinCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tarfin_cards', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('number');
            $table->string('type');
            $table->dateTime('expiration_date');
            $table->dateTime('disabled_at')->nullable();

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
        Schema::dropIfExists('tarfin_cards');
    }
}
