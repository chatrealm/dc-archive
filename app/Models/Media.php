<?php
namespace Chatrealm\DCArchive\Models;

use Code16\Sharp\Form\Eloquent\Uploads\SharpUploadModel;

/**
 * Chatrealm\DCArchive\Models\Media
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $model_key
 * @property string|null $file_name
 * @property string|null $mime_type
 * @property string|null $disk
 * @property int|null $size
 * @property array|null $custom_properties
 * @property int|null $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-write mixed $file
 * @property-write mixed $transformed
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereModelKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Chatrealm\DCArchive\Models\Media whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Media extends SharpUploadModel {

	/**
	 * @var string The table associated with the model.
	 */
	protected $table = 'medias';

}
