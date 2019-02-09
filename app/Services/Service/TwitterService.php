<?php
namespace Chatrealm\DCArchive\Services\Service;

class TwitterService extends BaseService {
	public function getLabel() {
		return 'Twitter';
	}

	public function getURL($identifier) {
		return "https://twitter.com/{$identifier}";
	}

	public function getIcon() {
		return 'twitter';
	}

}
