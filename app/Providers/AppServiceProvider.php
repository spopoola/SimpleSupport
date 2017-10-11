<?php

namespace App\Providers;

use App\Generators\TicketNumberGenerator;
use App\Generators\UniqueIDGeneration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UniqueIDGeneration::class, TicketNumberGenerator::class);
    }
}
