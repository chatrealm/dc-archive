<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Chatrealm\DCArchive\Models\Video
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $recorded_at
 * @property string $youtube_id
 * @property int|null $channel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $duration
 * @property-read \Chatrealm\DCArchive\Models\Channel|null $channel
 * @property-read string $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereRecordedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Video whereYoutubeId($value)
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
	 */
	public function channel() {
		return $this->belongsTo(Channel::class);
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
	 * Get thumbnail of the video
	 *
	 * @return string
	 */
	public function getThumbnailAttribute() {
		return 'https://i.ytimg.com/vi/' . $this->youtube_id . '/mqdefault.jpg';
	}

}
