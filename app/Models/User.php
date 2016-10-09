<?php

namespace Chatrealm\DCArchive\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Chatrealm\DCArchive\Models\User
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $is_admin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Chatrealm\DCArchive\Models\User whereIsAdmin($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_admin' => 'boolean',
	];

}
