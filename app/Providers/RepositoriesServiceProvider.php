<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('App\Repositories\UserRepository', 'App\Repositories\UserRepositoryEloquent');
      $this->app->bind('App\Repositories\EquiposRepository', 'App\Repositories\EquiposRepositoryEloquent');
      $this->app->bind('App\Repositories\JugadoresEquiposRepository', 'App\Repositories\JugadoresEquiposRepositoryEloquent');
      $this->app->bind('App\Repositories\PosicionesRepository', 'App\Repositories\PosicionesRepositoryEloquent');
      $this->app->bind('App\Repositories\ZonasRepository', 'App\Repositories\ZonasRepositoryEloquent');
      $this->app->bind('App\Repositories\CiudadesRepository', 'App\Repositories\CiudadesRepositoryEloquent');
      $this->app->bind('App\Repositories\CanchasRepository', 'App\Repositories\CanchasRepositoryEloquent');
      $this->app->bind('App\Repositories\RetosRepository', 'App\Repositories\RetosRepositoryEloquent');

    }
}
