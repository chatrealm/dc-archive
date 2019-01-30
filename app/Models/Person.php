<?php

namespace Chatrealm\DCArchive\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
