<?php
namespace Chatrealm\DCArchive\Services\Service;

class PatreonService extends BaseService {
	public function getLabel() {
		return 'Patreon';
	}

	public function getURL($identifier) {
		return "https://www.patreon.com/{$identifier}";
	}

}
