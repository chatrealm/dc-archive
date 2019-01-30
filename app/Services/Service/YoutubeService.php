<?php
namespace Chatrealm\DCArchive\Services\Service;

class YoutubeService extends BaseService {
	public function getLabel() {
		return 'Youtube';
	}

	public function getURL($identifier) {
		return "https://www.youtube.com/user/{$identifier}";
	}

}
