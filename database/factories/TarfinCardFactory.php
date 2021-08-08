<?php

namespace Database\Factories;

use App\Models\TarfinCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TarfinCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TarfinCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id'         => User::factory(),
            'number'          => $this->faker->creditCardNumber(),
            'type'            => $this->faker->creditCardType(),
            'expiration_date' => $this->faker->dateTimeBetween('+1 month', '+3 year'),
            'disabled_at'     => $this->faker->boolean() ? Carbon::now() : null,
        ];
    }
}
