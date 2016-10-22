<?php

namespace Chatrealm\DCArchive\Providers;

use Cache;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\ServiceProvider;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Psr\Http\Message\RequestInterface;

class YoutubeServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton('youtube.client', function() {
			$stack = HandlerStack::create();
			// Add YouTube API key
			$stack->unshift(Middleware::mapRequest(function (RequestInterface $request) {
				return $request->withUri(Uri::withQueryValue($request->getUri(), 'key', config('services.google.key')));
			}));
			$stack->push(new CacheMiddleware(new PrivateCacheStrategy(new LaravelCacheStorage(Cache::store('file')))), 'cache');

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
