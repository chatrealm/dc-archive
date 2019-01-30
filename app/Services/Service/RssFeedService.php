<?php
namespace Chatrealm\DCArchive\Services\Service;

class RssFeedService extends BaseService {
	public function getLabel() {
		return 'RSS Feed';
	}

	public function getURL($identifier) {
		return $identifier;
	}

}
