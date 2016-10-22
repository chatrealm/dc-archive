<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Video extends Model {
	use Sluggable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'channel_id', 'description', 'duration', 'published_at', 'recorded_at', 'title', 'youtube_id'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'published_at', 'recorded_at'
	];

	/**
	 * Sluggable configuration for the model
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'title',
				'maxLength' => 56
			]
		];
	}

}
