<?php
$menu = [
	[
		'label' => 'Admin',
		'items' => [
			['text' => 'Home', 'url' => route('admin.index'), 'active' => 'admin.index']
		]
	],
	[
		'label' => 'Content',
		'items' => [
			['text' => 'Channels', 'url' => route('admin.channel.index'), 'active' => 'admin.channel*']
		]
	],
	[
		'label' => 'Users',
		'items' => [
			['text' => 'Users', 'url' => route('admin.user.index'), 'active' => 'admin.user*']
		]
	]
];
?>
@include('partials.menu', ['menu' => $menu])
