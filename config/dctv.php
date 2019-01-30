<?php

return [
	// Livehub installation to use
	'livehub' => env('DCTV_LIVEHUB', 'http://livehub.app'),

	// Show login links in menu
	'show_login' => env('DCTV_SHOW_LOGIN', false),

	// Tiers people can be
	'people_tiers' => [
		null => 'None',
		1 => 'Staff',
		2 => 'Stream Team',
		3 => 'Core'
	]
];
