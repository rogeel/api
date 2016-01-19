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
      $this->app->bind('App\Repositories\Equipos', 'App\Repositories\EquiposRepositoryEloquent');
      $this->app->bind('App\Repositories\JugadoresEquiposRepository', 'App\Repositories\JugadoresEquiposRepositoryEloquent');
      $this->app->bind('App\Repositories\ExpertiseTopicRepository', 'App\Repositories\ExpertiseTopicRepositoryEloquent');
      $this->app->bind('App\Repositories\CountryRepository', 'App\Repositories\CountryRepositoryEloquent');
      $this->app->bind('App\Repositories\AddressRepository', 'App\Repositories\AddressRepositoryEloquent');
      $this->app->bind('App\Repositories\JobRepository', 'App\Repositories\JobRepositoryEloquent');
      $this->app->bind('App\Repositories\LanguagesProfileRepository', 'App\Repositories\LanguagesProfileRepositoryEloquent');
      $this->app->bind('App\Repositories\EducationRepository', 'App\Repositories\EducationRepositoryEloquent');
      $this->app->bind('App\Repositories\ReferenceRepository', 'App\Repositories\ReferenceRepositoryEloquent');
      $this->app->bind('App\Repositories\PublicationRepository', 'App\Repositories\PublicationRepositoryEloquent');
      $this->app->bind('App\Repositories\LanguagesRepository', 'App\Repositories\LanguagesRepositoryEloquent');
    }
}
