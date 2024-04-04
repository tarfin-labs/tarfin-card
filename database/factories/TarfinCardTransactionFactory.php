<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TarfinCard;
use App\Enums\CurrencyType;
use App\Models\TarfinCardTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TarfinCardTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TarfinCardTransaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tarfin_card_id' => TarfinCard::factory(),
            'amount'         => fake()->numberBetween(int1: 100, int2: 999) * 10,
            'currency_code'  => fake()->randomElement(CurrencyType::cases()),
        ];
    }
}
