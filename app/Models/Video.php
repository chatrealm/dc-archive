<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Chatrealm\DCArchive\Models\Video
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon $recorded_at
 * @property string $youtube_id
 * @property integer $channel_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $duration
 * @property-read \Chatrealm\DCArchive\Models\Channel $channel
 * @property-read mixed $thumbnail
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereRecordedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereYoutubeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereChannelId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\Video findSimilarSlugs($model, $attribute, $config, $slug)
 * @mixin \Eloquent
 */
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

	/**
	 * Channel this video belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 **/
	public function channel() {
		return $this->belongsTo(Channel::class);
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
	 * Get thumbnail of the video
	 *
	 * @return string
	 */
	public function getThumbnailAttribute() {
		return 'https://i.ytimg.com/vi/' . $this->youtube_id . '/mqdefault.jpg';
	}

}
