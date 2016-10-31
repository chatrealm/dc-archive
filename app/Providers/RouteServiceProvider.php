<?php

namespace Chatrealm\DCArchive\Providers;

use Chatrealm\DCArchive\Models\Channel;
use Chatrealm\DCArchive\Models\Video;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Chatrealm\DCArchive\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot() {
		parent::boot();

		Route::model('channel', Channel::class);
		Route::bind('channel_id', function ($value) {
			return Channel::where('id', $value)->firstOrFail();
		});
		Route::model('video', Video::class);
		Route::bind('video_id', function ($value) {
			return Video::where('id', $value)->firstOrFail();
		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map() {
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		//
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes() {
		Route::group([
			'middleware' => 'web',
			'namespace' => $this->namespace,
		], function($router) {
			require base_path('routes/web.php');
		});
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes() {
		Route::group([
			'middleware' => 'api',
			'namespace' => $this->namespace,
			'prefix' => 'api',
		], function($router) {
			require base_path('routes/api.php');
		});
	}

}
