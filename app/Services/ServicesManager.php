<?php
namespace Chatrealm\DCArchive\Services;

use Chatrealm\DCArchive\Services\Service\BaseService;
use Chatrealm\DCArchive\Services\Service\FacebookService;
use Chatrealm\DCArchive\Services\Service\HomepageService;
use Chatrealm\DCArchive\Services\Service\InstagramService;
use Chatrealm\DCArchive\Services\Service\MixerService;
use Chatrealm\DCArchive\Services\Service\PatreonService;
use Chatrealm\DCArchive\Services\Service\RssFeedService;
use Chatrealm\DCArchive\Services\Service\TwitchService;
use Chatrealm\DCArchive\Services\Service\TwitterService;
use Chatrealm\DCArchive\Services\Service\YoutubeService;

class ServicesManager {

	/**
	 * @var array Usable services
	 */
	protected $services;

	public function __construct() {
		$this->services = [
			'homepage' => new HomepageService(),
			'twitter' => new TwitterService(),
			'instagram' => new InstagramService(),
			'facebook' => new FacebookService(),
			'patreon' => new PatreonService(),
			'youtube' => new YoutubeService(),
			'twitch' => new TwitchService(),
			'mixer' => new MixerService(),
			'rssfeed' => new RssFeedService()
		];
	}

	/**
	 * Get available service keys
	 *
	 * @return array
	 */
	public function availableServicesKeys() {
		return array_keys($this->services);
	}

	/**
	 * Get available services in an array suitable to Sharp
	 *
	 * @return array
	 */
	public function availableServicesList() {
		return array_map(function ($key, BaseService $service) {
			return ['id' => $key, 'label' => $service->getLabel()];
		}, array_keys($this->services), $this->services);
	}

	/**
	 * @param string $service Service name
	 * @return \Chatrealm\DCArchive\Services\Service\BaseService|null
	 */
	protected function getService($service) {
		if (!array_key_exists($service, $this->services)) {
			return null;
		}
		return $this->services[$service];
	}

	/**
	 * @param string $service_id Service name
	 * @param string $identifier Identifier on the service
	 * @return string
	 */
	public function getURL($service_id, $identifier) {
		$service = $this->getService($service_id);

		if ($service) {
			return $service->getURL($identifier);
		}
		return $identifier;
	}

	/**
	 * @param string $service_id Service name
	 * @return string
	 */
	public function getIcon($service_id) {
		$service = $this->getService($service_id);

		if ($service) {
			return $service->getIcon();
		}
		return 'external-link-alt';
	}

	/**
	 * @param string $service_id Service name
	 * @return string
	 */
	public function getLabel($service_id) {
		$service = $this->getService($service_id);

		if ($service) {
			return $service->getLabel();
		}
		return 'external-link-alt';
	}

}
