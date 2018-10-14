<?php
namespace Chatrealm\DCArchive\Sharp\Filters;

use Code16\Sharp\EntityList\EntityListFilter;

class UserAdminFilter implements EntityListFilter {
	public function values() {
		return [
			true => 'Admins',
			false => 'Normal Users'
		];
	}

}
