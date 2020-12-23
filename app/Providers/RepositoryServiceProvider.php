<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Interfaces\VehicleExtensionRepositoryInterface;
use App\Repository\BaseRepository;

/** 
 * Class RepositoryServiceProvider 
 * @package App\Providers 
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VehicleExtensionRepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
