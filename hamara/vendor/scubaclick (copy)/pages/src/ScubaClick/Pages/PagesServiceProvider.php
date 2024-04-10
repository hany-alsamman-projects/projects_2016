<?php namespace ScubaClick\Pages;

use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('scubaclick/pages');
	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'ScubaClick\\Pages\\Contracts\\PagesInterface',
            'ScubaClick\\Pages\\Repositories\\Eloquent\\PagesRepository'
        );

        $this->app->bind(
            'ScubaClick\\Pages\\Contracts\\CommentsInterface',
            'ScubaClick\\Pages\\Repositories\\Eloquent\\CommentsRepository'
        );

        $this->app->bind(
            'ScubaClick\\Pages\\Contracts\\CategoriesInterface',
            'ScubaClick\\Pages\\Repositories\\Eloquent\\CategoriesRepository'
        );

        $this->app->bind(
            'ScubaClick\\Pages\\Contracts\\TagsInterface',
            'ScubaClick\\Pages\\Repositories\\Eloquent\\TagsRepository'
        );
    }
}
