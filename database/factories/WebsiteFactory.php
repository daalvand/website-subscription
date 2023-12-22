<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    protected $model = Website::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->domainWord,
            'url'  => $this->faker->url,
        ];
    }
}
