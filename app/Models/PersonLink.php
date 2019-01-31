<?php

namespace Chatrealm\DCArchive\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Chatrealm\DCArchive\Models\PersonLink
 *
 * @property int $id
 * @property int $person_id
 * @property string|null $service
 * @property string|null $label
 * @property string|null $service_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereServiceData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\PersonLink whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PersonLink extends Model {
	public function getUrlAttribute() {
		/** @var \Chatrealm\DCArchive\Services\ServicesManager $services */
		$services = resolve(ServicesManager::class);

		return $services->getURL($this->service, $this->service_data);
	}

}
