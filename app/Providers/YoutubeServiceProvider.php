<?php

namespace Chatrealm\DCArchive\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Message\RequestInterface;

class YoutubeServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton('youtube.client', function($app) {
			$stack = HandlerStack::create();
			// Add YouTube API key
			$stack->unshift(Middleware::mapRequest(function (RequestInterface $request) {
				return $request->withUri(Uri::withQueryValue($request->getUri(), 'key', config('services.google.key')));
			}));

			return new Client([
				'base_uri' => 'https://www.googleapis.com/youtube/v3/',
				'handler' => $stack
			]);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return ['youtube.client'];
	}

}
