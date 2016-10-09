<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

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
	 **/
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
	 **/
	public function getPlaylistUrlAttribute() {
		return 'https://www.youtube.com/playlist?list=' . $this->uploads_playlist;
	}

}
