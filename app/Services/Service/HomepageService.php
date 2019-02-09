<?php
namespace Chatrealm\DCArchive\Services\Service;

class HomepageService extends BaseService {
	public function getLabel() {
		return 'Homepage';
	}

	public function getURL($identifier) {
		return $identifier;
	}

	public function getIcon() {
		return 'home';
	}

}
