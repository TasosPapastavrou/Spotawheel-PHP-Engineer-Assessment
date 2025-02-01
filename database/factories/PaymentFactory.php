<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Client; 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 100000),
            'client_id' => Client::inRandomOrder()->first()->id,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now(),
        ];
    }
}
