<?php namespace ScubaClick\Feeder\Providers;

use ScubaClick\Feeder\Feeder;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('scubaclick/feeder', null, __DIR__ .'/../../..');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['feeder'] = $this->app->share(function($app) {
            return new Feeder;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('feeder');
	}
}
