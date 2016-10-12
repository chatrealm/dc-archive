<?php

namespace Chatrealm\DCArchive\Jobs;

use Carbon\Carbon;
use Chatrealm\DCArchive\Models\Channel;
use Chatrealm\DCArchive\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanChannelForNewVideos implements ShouldQueue {
	use InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * @var \Chatrealm\DCArchive\Models\Channel
	 */
	protected $channel;

	/**
	 * @var bool Do a full scan of the whole playlist
	 */
	public $fullScan = false;

	/**
	 * Create a new job instance.
	 *
	 * @param \Chatrealm\DCArchive\Models\Channel $channel
	 * @param bool $fullScan
	 */
	public function __construct(Channel $channel, $fullScan = false) {
		$this->channel = $channel;
		$this->fullScan = $fullScan;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		if (!$this->channel->uploads_playlist) {
			return $this->delete();
		}
		if ($this->channel->last_updated && $this->channel->last_updated->gt(Carbon::now()->subMinutes(15)) && !$this->fullScan) {
			return $this->delete();
		}

		list($resultsToBeProcessed, $alreadyInDatabase) = $this->scanYoutube();
		$resultsToBeProcessed = $this->processAlreadyExisting($resultsToBeProcessed, $alreadyInDatabase);
		$this->addMissingVideos($resultsToBeProcessed);

		$this->channel->last_updated = Carbon::now();
		$this->channel->save();
	}

	/**
	 * Scan youtube for videos
	 *
	 * @return \Illuminate\Support\Collection[]
	 **/
	protected function scanYoutube() {
		$client = app('youtube.client');

		$query = [
			'fields' => 'items(snippet(channelId,description,publishedAt,resourceId/videoId,title)),nextPageToken',
			'maxResults' => 5,
			'part' => 'snippet',
			'playlistId' => $this->channel->uploads_playlist
		];
		$nextPageToken = null;
		$initial = true;
		$resultsToBeProcessed = collect();
		$alreadyInDatabase = collect();

		if ($this->fullScan) {
			// Start scanning the full thing
			$initial = false;
			$query['maxResults'] = config('jobs.youtube.playlist_items.max_per_page');
		}

		$lookForMore = true;

		while ($lookForMore) {
			$response = $client->get('playlistItems', [
				'query' => $query
			]);
			$playlistPart = json_decode($response->getBody());

			$videos = collect($playlistPart->items);
			if (!$videos->count()) {
				break;
			}

			// Check database if any are already in it
			$videoIDs = $videos->pluck('snippet.resourceId.videoId');
			$databaseVideos = Video::whereIn('youtube_id', $videoIDs)->get()->keyBy('youtube_id');

			// If the last video is in database assume older videos are too.
			if (
				!$this->fullScan
				&& $this->channel->last_updated
				&& $this->channel->last_updated->gt(Carbon::parse($videos->last()->snippet->publishedAt))
			) {
				$lookForMore = false;
			}

			// Store next page token if needed
			if ($lookForMore) {
				if ($initial) { // Restart from start, fetching more per page. Also don't add already found to cache
					$initial = false;
					$query['maxResults'] = config('jobs.youtube.playlist_items.max_per_page');
					continue;
				}
				if (property_exists($playlistPart, 'nextPageToken')) {
					$query['pageToken'] = $playlistPart->nextPageToken;
				} else {
					$lookForMore = false;
				}
			}

			// Add already found to the cache
			$resultsToBeProcessed = $resultsToBeProcessed->merge($videos);
			$alreadyInDatabase = $alreadyInDatabase->merge($databaseVideos);
		}

		return [$resultsToBeProcessed, $alreadyInDatabase];
	}

	/**
	 * Check already existing videos and update them if needed
	 *
	 * @param \Illuminate\Support\Collection $resultsToBeProcessed Youtube results that should be processed
	 * @param \Illuminate\Support\Collection $alreadyInDatabase Items already found in database, keyed by youtube ID
	 * @return \Illuminate\Support\Collection Things left to be added
	 **/
	public function processAlreadyExisting($resultsToBeProcessed, $alreadyInDatabase) {
		$toBeAdded = $resultsToBeProcessed->reject(function($youtubeVideo) use($alreadyInDatabase) {
			if ($alreadyInDatabase->has($youtubeVideo->snippet->resourceId->videoId)) {
				$dbVideo = $alreadyInDatabase->get($youtubeVideo->snippet->resourceId->videoId);

				$dbVideo->fill([
					'title' => $youtubeVideo->snippet->title,
					'description' => $youtubeVideo->snippet->description,
					'published_at' => Carbon::parse($youtubeVideo->snippet->publishedAt),
					'youtube_id' => $youtubeVideo->snippet->resourceId->videoId,
					'channel_id' => $this->channel->id
				]);

				$dbVideo->save();

				return true;
			}
			return false;
		});
		return $toBeAdded;
	}

	/**
	 * Add videos that are missing
	 *
	 * @param \Illuminate\Support\Collection $youtubeVideos Youtube videos to add
	 *
	 * @return void
	 **/
	public function addMissingVideos($youtubeVideos) {
		// Add in reverse order to maintain order
		$insertables = $youtubeVideos->reverse()->map(function($youtubeVideo) {
			// Save one by one to allow slugging
			Video::create([
				'title' => $youtubeVideo->snippet->title,
				'description' => $youtubeVideo->snippet->description,
				'published_at' => Carbon::parse($youtubeVideo->snippet->publishedAt),
				'youtube_id' => $youtubeVideo->snippet->resourceId->videoId,
				'channel_id' => $this->channel->id
			]);
		});
	}

}
