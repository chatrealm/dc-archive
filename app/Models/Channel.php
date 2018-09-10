<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Chatrealm\DCArchive\Models\Channel
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $youtube_id
 * @property string $uploads_playlist
 * @property \Carbon\Carbon $last_updated
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $url
 * @property-read mixed $playlist_url
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereYoutubeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereUploadsPlaylist($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Channel findSimilarSlugs($model, $attribute, $config, $slug)
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

}
