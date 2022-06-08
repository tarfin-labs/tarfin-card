<?php

declare(strict_types=1);

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

    /**
     * Set customer for Tarfin Card.
     */
    public function forCustomer(User $customer): Factory
    {
        return $this->state(fn (): array => [
            'user_id' => $customer->id,
        ]);
    }

    /**
     * Indicate that the Tarfin Card is active.
     */
    public function active(): Factory
    {
        return $this->state(fn (): array => [
            'disabled_at' => null,
        ]);
    }

    /**
     * Indicate that the Tarfin Card is deactive.
     */
    public function deactive(): Factory
    {
        return $this->state(fn (): array => [
            'disabled_at' => Carbon::now()->subDays($this->faker->numberBetween(1, 10)),
        ]);
    }

    /**
     * Indicate that the Tarfin Card is expired.
     */
    public function expired(): Factory
    {
        return $this->state(fn () => [
            'disabled_at' => $this->faker->dateTime(),
        ]);
    }
}
