<?php

/**
 * Nav configuration file
 *
 * The array is structured as follows:
 *
 *     array(
 *         'GROUP' => array(
 *             'current_class' => 'CLASSNAME',
 *             'items' => array(
 *                 'LABEL' => array(
 *                     'url' => 'URL',
 *                     'triggers' => array(
 *                         'URL2',
 *                         'URL3',
 *                           .
 *                           .
 *                           .
 *                     ),
 *                 ),
 *             ),
 *         ),
 *     )
 *
 *    GROUP     - Group to which the nav array belongs.
 *    CLASSNAME - The CSS class for active items.
 *    LABEL     - Label of this link.
 *    URL       - The URL of the link.
 *    URL2      - URL that triggers a link to be active. * for wildcard
 *    URL3      - Another URL that triggers a link to be active. * for wildcard
 */

return array(
	// the main menu
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
);
