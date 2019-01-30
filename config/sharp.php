<?php

use Chatrealm\DCArchive\Policies\AdminPolicy;
use Chatrealm\DCArchive\Sharp\ChannelForm;
use Chatrealm\DCArchive\Sharp\ChannelList;
use Chatrealm\DCArchive\Sharp\ChannelValidator;
use Chatrealm\DCArchive\Sharp\PageForm;
use Chatrealm\DCArchive\Sharp\PageList;
use Chatrealm\DCArchive\Sharp\PageValidator;
use Chatrealm\DCArchive\Sharp\PersonForm;
use Chatrealm\DCArchive\Sharp\PersonList;
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
			'form' => ChannelForm::class,
			'validator' => ChannelValidator::class,
		],
		'page' => [
			'list' => PageList::class,
			'form' => PageForm::class,
			'validator' => PageValidator::class
		],
		'person' => [
			'list' => PersonList::class,
			'form' => PersonForm::class
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
			'label' => 'Back To Site',
			'url' => '/'
		],
		[
			'label' => 'Content',
			'entities' => [
				[
					'label' => 'Channels',
					'icon' => 'fa-television',
					'entity' => 'channel'
				],
				[
					'label' => 'People',
					'icon' => 'fa-user',
					'entity' => 'person'
				],
				[
					'label' => 'Pages',
					'icon' => 'fa-file-text',
					'entity' => 'page'
				]
			]
		],
		[
			'label' => 'Site',
			'entities' => [
				[
					'label' => 'Users',
					'icon' => 'fa-users',
					'entity' => 'user'
				]
			]
		]
	],
	'uploads' => [
		'tmp_dir' => env('SHARP_UPLOADS_TMP_DIR', 'tmp'),
		'thumbnails_dir' => env('SHARP_UPLOADS_THUMB_DIR', 'storage/thumb')
	]
];
