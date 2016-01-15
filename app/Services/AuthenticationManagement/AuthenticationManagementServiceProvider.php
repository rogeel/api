<?php 

namespace App\Services\AuthenticationManagement;

use Illuminate\Support\ServiceProvider;


class AuthenticationManagementServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// Binds 'userService' to the result of the closure
		$this->app->singleton('authenticationManagement', function($app)
		{
			return new AuthenticationManagement(
			// Inject in our class of pokemonInterface, this will be our repository
			);
		});
	}

}
