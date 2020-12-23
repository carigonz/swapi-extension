<?php

namespace App\Providers;

use App\Http\Controllers\VehicleController;
use Illuminate\Support\ServiceProvider;

use App\Repository\Interfaces\EloquentRepositoryInterface;
use App\Repository\Interfaces\VehicleExtensionRepositoryInterface;
use App\Repository\BaseRepository;
use App\Repository\VehicleRepository;

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
