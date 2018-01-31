<?php namespace viralfbpackage\Installer;

use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__.'/Http/routes.php';
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//$this->app->make('viralfbpackage\Installer\Http\Controllers\WelcomeController');

		$this->loadViewsFrom(__DIR__.'/../views', 'installer');
	}

}
