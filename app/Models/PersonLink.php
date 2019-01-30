<?php

namespace Chatrealm\DCArchive\Models;

use Illuminate\Database\Eloquent\Model;

class PersonLink extends Model {
	public function getUrlAttribute() {
		/** @var \Chatrealm\DCArchive\Services\ServicesManager $services */
		$services = resolve(ServicesManager::class);

		return $services->getURL($this->service, $this->service_data);
	}

}
