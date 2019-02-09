<?php
namespace Chatrealm\DCArchive\Services\Service;

class FacebookService extends BaseService {
	public function getLabel() {
		return 'Facebook';
	}

	public function getURL($identifier) {
		return "https://www.facebook.com/{$identifier}";
	}

	public function getIcon() {
		return 'facebook';
	}

}
