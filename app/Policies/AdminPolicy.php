<?php

namespace Chatrealm\DCArchive\Policies;

use Code16\Sharp\Auth\SharpAuthenticationCheckHandler;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy implements SharpAuthenticationCheckHandler {
	use HandlesAuthorization;

	/**
	 * Check if user is an admin
	 *
	 * @param \Chatrealm\DCArchive\Models\User $user
	 * @return bool
	 */
	public function check($user): bool {
		return (bool)$user->is_admin;
	}

}
