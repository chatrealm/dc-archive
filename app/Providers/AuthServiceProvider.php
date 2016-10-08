<?php

namespace Chatrealm\DCArchive\Providers;

use Chatrealm\DCArchive\Models\User;
use Chatrealm\DCArchive\Policies\UserPolicy;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		User::class => UserPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->registerPolicies();

		Gate::define('is-admin', function(User $user) {
			return $user->is_admin;
		});
	}

}
