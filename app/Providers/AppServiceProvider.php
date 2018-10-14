<?php

namespace Chatrealm\DCArchive\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Chatrealm\DCArchive\Sharp\Bugfixes\BindSharpValidationResolver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		if ($this->app->environment() !== 'production') {
			$this->app->register(IdeHelperServiceProvider::class);
		}

		// Register sharp fixes
		$this->app['router']->aliasMiddleware(
			'sharp_api_validation', BindSharpValidationResolver::class
		);
	}

}
