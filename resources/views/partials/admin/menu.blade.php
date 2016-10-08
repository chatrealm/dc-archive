<?php
$menu = [
	[
		'label' => 'Admin',
		'items' => [
			['text' => 'Home', 'url' => route('admin.index'), 'active' => 'admin.index']
		]
	],
	[
		'label' => 'Users',
		'items' => [
			['text' => 'Users', 'url' => route('admin.users.index'), 'active' => 'admin.users*']
		]
	]
];
?>
@include('partials.menu', ['menu' => $menu])
