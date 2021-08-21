<?php

namespace Database\Factories;

use App\Constants\CurrencyType;
use App\Models\TarfinCard;
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
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'tarfin_card_id' => TarfinCard::factory(),
            'amount'         => $this->faker->numberBetween(100, 999) * 10,
            'currency_code'  => $this->faker->randomElement(CurrencyType::ALL),
        ];
    }
}
