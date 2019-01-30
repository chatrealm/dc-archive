<?php
namespace Chatrealm\DCArchive\Services\Service;

class MixerService extends BaseService {
	public function getLabel() {
		return 'Mixer';
	}

	public function getURL($identifier) {
		return "https://mixer.com/{$identifier}";
	}

}
