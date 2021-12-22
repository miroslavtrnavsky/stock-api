<?php

namespace App\Providers;

use App\Services\Contracts\ApiServiceInterface;
use App\Services\PackageApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        collect(config('api.fake_clients'))->each(fn (string $client) =>
            $this->app->bind(ApiServiceInterface::class, $client)
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
