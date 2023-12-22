<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'website_id' => Website::factory(),
            'email'      => $this->faker->unique()->safeEmail,
        ];
    }
}
