<?php

use Chatrealm\DCArchive\Policies\AdminPolicy;
use Chatrealm\DCArchive\Sharp\ChannelForm;
use Chatrealm\DCArchive\Sharp\ChannelList;
use Chatrealm\DCArchive\Sharp\UserForm;
use Chatrealm\DCArchive\Sharp\UserList;
use Chatrealm\DCArchive\Sharp\UserValidator;

return [
	'name' => env('APP_NAME', 'Diamond Club TV'),
	'auth' => [
		'check_handler' => AdminPolicy::class,
		'display_attribute' => 'username',
		'login_page_url' => '/login'
	],
	'entities' => [
		'channel' => [
			'list' => ChannelList::class,
			'form' => ChannelForm::class
		],
		'user' => [
			'list' => UserList::class,
			'form' => UserForm::class,
			'validator' => UserValidator::class,
			'authorizations' => [
				'create' => false,
				'delete' => false
			]
		]
	],
	'menu' => [
		[
			'label' => 'Content',
			'entities' => [
				'channel' => [
					'label' => 'Channels',
					'icon' => 'fa-television'
				]
			]
		],
		[
			'label' => 'Site',
			'entities' => [
				'user' => [
					'label' => 'Users',
					'icon' => 'fa-user'
				]
			]
		]
	]
];
