<?php
namespace Chatrealm\DCArchive\Services\Service;

class InstagramService extends BaseService {
	public function getLabel() {
		return 'Instagram';
	}

	public function getURL($identifier) {
		return "https://www.instagram.com/{$identifier}";
	}

}
