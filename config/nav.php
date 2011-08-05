<?php


return array(
	'public' => array(
		'current_class' => 'current',
		'items' => array(
			'Home' => array(
				'url' => '',
				'triggers' => array('/'),
			),
			'CRUD' => array(
				'url' => 'crude/crud/tables',
				'triggers' => array(
					'crude',
					'crude/crud/*',
				),
			),
		),
	),
	'dashboard' => array(
		'current_class' => 'current',
		'items' => array(
			'Paths' => array(
				'url' => 'crude/dashboard/fuelinfo/paths',
				'triggers' => array(
					'crude',
					'crude/dashboard/fuelinfo/paths',
				),
			),
			'Routes' => array(
				'url' => 'crude/dashboard/fuelinfo/routes',
				'triggers' => array('crude/dashboard/fuelinfo/routes'),
			),
			'Request' => array(
				'url' => 'crude/dashboard/fuelinfo/request',
				'triggers' => array('crude/dashboard/fuelinfo/request'),
			),
			'Modules' => array(
				'url' => 'crude/dashboard/fuelinfo/modules',
				'triggers' => array('crude/dashboard/fuelinfo/modules'),
			),
			'Packages' => array(
				'url' => 'crude/dashboard/fuelinfo/packages',
				'triggers' => array('crude/dashboard/fuelinfo/packages'),
			),
			'Database' => array(
				'url' => 'crude/dashboard/fuelinfo/database',
				'triggers' => array('crude/dashboard/fuelinfo/database'),
			),
			'Session' => array(
				'url' => 'crude/dashboard/fuelinfo/session',
				'triggers' => array('crude/dashboard/fuelinfo/session'),
			),
			'Config' => array(
				'url' => 'crude/dashboard/fuelinfo/config',
				'triggers' => array('crude/dashboard/fuelinfo/config'),
			),
			'phpinfo' => array(
				'url' => 'crude/dashboard/phpinfo',
				'triggers' => array('crude/dashboard/phpinfo'),
			),
		),
	)
);
