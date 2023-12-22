<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteWithSubscriptionsAndPostsSeeder extends Seeder
{
    public function run(): void
    {
        Website::factory()->hasSubscriptions(5)->hasPosts(10)->create();
    }
}

