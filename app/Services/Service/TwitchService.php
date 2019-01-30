<?php
namespace Chatrealm\DCArchive\Services\Service;

class TwitchService extends BaseService {
	public function getLabel() {
		return 'Twitch';
	}

	public function getURL($identifier) {
		return "https://twitch.tv/{$identifier}";
	}

}
