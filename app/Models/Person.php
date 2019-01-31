<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Chatrealm\DCArchive\Models\Person
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $about
 * @property int|null $tier
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $tier_string
 * @property-read \Chatrealm\DCArchive\Models\Media $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\Chatrealm\DCArchive\Models\PersonLink[] $links
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Person whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Person extends Model {
	use Sluggable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'people';

	/**
	 * Sluggable configuration
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
	 * Person's image
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function image(): MorphOne {
		return $this->morphOne(Media::class, 'model')->where('model_key', 'image');
	}

	/**
	 * Person's links
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function links(): HasMany {
		return $this->hasMany(PersonLink::class);
	}

	public function getDefaultAttributesFor($attribute) {
		return in_array($attribute, ['image'])
			? ['model_key' => $attribute]
			: [];
	}

	public function getTierStringAttribute() {
		$tiers = config('dctv.people_tiers');
		return $tiers[$this->tier] ?? $tiers[null];
	}

}
