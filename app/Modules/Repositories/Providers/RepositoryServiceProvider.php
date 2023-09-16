<?php

namespace App\Modules\Repositories\Providers;
use App\Modules\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        BaseRepository::setCacheInstance($this->app['cache']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
