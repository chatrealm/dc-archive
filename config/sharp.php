<?php

use Chatrealm\DCArchive\Policies\AdminPolicy;
use Chatrealm\DCArchive\Sharp\ChannelForm;
use Chatrealm\DCArchive\Sharp\ChannelList;
use Chatrealm\DCArchive\Sharp\ChannelValidator;
use Chatrealm\DCArchive\Sharp\PageForm;
use Chatrealm\DCArchive\Sharp\PageList;
use Chatrealm\DCArchive\Sharp\PageValidator;
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
				],
				'page' => [
					'label' => 'Pages',
					'icon' => 'fa-file-text'
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
