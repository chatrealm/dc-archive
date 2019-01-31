<?php

namespace Chatrealm\DCArchive\Models;

use Chatrealm\DCArchive\Observers\ChannelObserver;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Chatrealm\DCArchive\Models\Channel
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $youtube_id
 * @property string $uploads_playlist
 * @property \Illuminate\Support\Carbon|null $last_updated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $playlist_url
 * @property-read string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereUploadsPlaylist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Channel whereYoutubeId($value)
 * @mixin \Eloquent
 */
class Channel extends Model {
	use Sluggable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'slug', 'youtube_id'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'last_updated'
	];

	/**
	 * @return void
	 */
	public static function boot() {
		parent::boot();

		static::observe(ChannelObserver::class);
	}

	/**
	 * Sluggable configuration for the model
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	/**
	 * Get the route key for the model
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'slug';
	}

	/**
	 * Get URL of the channel
	 *
	 * @return string
	 */
	public function getUrlAttribute() {
		return 'https://www.youtube.com/channel/' . $this->youtube_id;
	}

	/**
	 * Get uploads playlist URL
	 *
	 * @return string
	 */
	public function getPlaylistUrlAttribute() {
		return 'https://www.youtube.com/playlist?list=' . $this->uploads_playlist;
	}

	/**
	 * Set youtube ID
	 *
	 * Checks if channel with ID exists and update playlist ID
	 *
	 * @param string $value
	 * @return void
	 */
	public function setYoutubeIdAttribute($value) {
		if ($this->originalIsEquivalent('youtube_id', $value)) {
			return;
		}

		// Get channel info
		$client = app('youtube.client');

		$response = $client->get('channels', [
			'query' => [
				'part' => 'contentDetails',
				'id' => $value,
				'fields' => 'items(contentDetails/relatedPlaylists/uploads,id)'
			]
		]);
		$youtubeChannel = json_decode($response->getBody());

		if (count($youtubeChannel->items) === 0) {
			throw ValidationException::withMessages([
				'youtube_id' => ['Invalid channel']
			]);
		}
		$channel = $youtubeChannel->items[0];
		$this->attributes['youtube_id'] = $value;
		$this->attributes['uploads_playlist'] = $channel->contentDetails->relatedPlaylists->uploads;
	}

}
