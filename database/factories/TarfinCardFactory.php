<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\TarfinCard;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'number'          => fake()->creditCardNumber(),
            'type'            => fake()->creditCardType(),
            'expiration_date' => fake()->dateTimeBetween(startDate: '+1 month', endDate: '+3 year'),
            'disabled_at'     => fake()->boolean() ? now() : null,
        ];
    }

    /**
     * Set the user id for the Tarfin Card.
     *
     * @param  User  $customer  The customer instance for which the factory is being created.
     */
    public function forCustomer(User $customer): Factory
    {
        return $this->state(fn (): array => [
            'user_id' => $customer->id,
        ]);
    }

    /**
     * Set the Tarfin Card as active.
     */
    public function active(): Factory
    {
        return $this->state(fn (): array => [
            'disabled_at' => null,
        ]);
    }

    /**
     * Deactivate the Tarfin Card by setting the disabled_at attribute to a random date in the past.
     */
    public function deactive(): Factory
    {
        return $this->state(fn (): array => [
            'disabled_at' => now()->subDays(fake()->numberBetween(int1: 1, int2: 10)),
        ]);
    }

    /**
     * Set the disabled_at attribute to a fake dateTime value, marking the entity as expired.
     */
    public function expired(): Factory
    {
        return $this->state(fn () => [
            'disabled_at' => fake()->dateTime(),
        ]);
    }
}
