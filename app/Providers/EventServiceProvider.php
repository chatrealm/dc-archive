<?php

namespace Chatrealm\DCArchive\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'Chatrealm\DCArchive\Events\SomeEvent' => [
			'Chatrealm\DCArchive\Listeners\EventListener',
		],
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot() {
		parent::boot();

		//
	}

}
