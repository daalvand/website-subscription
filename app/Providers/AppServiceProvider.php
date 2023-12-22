<?php

namespace App\Providers;

use App\Contracts\PostEmailService as PostEmailServiceContract;
use App\Service\PostEmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostEmailServiceContract::class, function () {
            return new PostEmailService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
