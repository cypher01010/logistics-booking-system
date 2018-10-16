<?php
return [
	'/' => 'site/index',

	'login' => 'user/login/index',
	'register' => 'user/register/index',
	'logout' => 'user/logout/index',
	'recover' => 'user/recover/index',
	'reset/<key>' => 'user/recover/reset',
	'dashboard' => 'user/crud/dashboard',
	'settings/personal-info' => 'user/info/index',
	'settings/password' => 'user/info/password',

	'user/create' => 'user/crud/create',
	'user/info/<id>' => 'user/crud/view',
	'user/update/<id>' => 'user/crud/update',
	'user/delete/<id>' => 'user/crud/delete',
	'user/<type>' => 'user/crud/list',

	'system/settings/smtp' => 'settings/default/smtp',

	'calendar' => 'delivery/crud/calendar',
	'signature/<id>' => 'delivery/crud/signature',
	'delivery/book' => 'delivery/crud/create',
	'delivery/list' => 'delivery/crud/index',
	'delivery/info/<id>' => 'delivery/crud/view',
	'delivery/update/<id>' => 'delivery/crud/update',
	'delivery/delete/<id>' => 'delivery/crud/delete',
	'delivery/print/<id>' => 'delivery/crud/pdf',
];