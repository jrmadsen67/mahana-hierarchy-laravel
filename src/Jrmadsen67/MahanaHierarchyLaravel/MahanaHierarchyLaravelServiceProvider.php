<?php namespace Jrmadsen67\MahanaHierarchyLaravel;

use Illuminate\Support\ServiceProvider;

class MahanaHierarchyLaravelServiceProvider extends ServiceProvider {

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
		$this->package('jrmadsen67/mahana-hierarchy-laravel');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $app['mahana_hierarchy_eloquent'] = function () {
            return new \Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy\HierarchyEloquentRepository;
        };    

        $app['mahana_hierarchy'] = function () {
            return new \Jrmadsen67\MahanaHierarchyLaravel\MahanaHierarchyLaravel(
                $this->app['mahana_hierarchy_eloquent']
            );
        };

		$this->app->bind('Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy\HierarchyRepositoryInterface', 'Jrmadsen67\MahanaHierarchyLaravel\repositories\Hierarchy\HierarchyEloquentRepository');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mahana-hierarchy-laravel');
	}

}
