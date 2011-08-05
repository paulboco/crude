<?php

/**
 * Crude configuration file
 */

return array (

	/**
	 * default_stencil - The stencil selected in action tables.
	 *
	 * This stencil must exist in the stencils direcotyr.
	 */
	'default_stencil'  => 'default_orm',

	/**
	 * crudzip_path - The path to where the zip file is created.
	 *
	 * This directory must exist and be writable by the webserver.
	 */
	'crudzip_path'     => TMPPATH.'crude'.DS,

	/**
	 * input_options - The options available for data type selects in action input.
	 *
	 * This is not complete. See file COREPATH/classes/database/mysql/connection.php for a complete list.
	 *
	 * The array is constructed as such:
	 *     'datatype' = array(
	 *         'input_type' => 'label',
	 *     )
	 */
	'input_options' => array(
		'int' => array (
			'text'   => 'text',
			'select' => 'select',
		),
		'int unsigned' => array(
			'text'   => 'text',
			'select' => 'select',
		),
		'mediumint unsigned' => array(
			'text'   => 'text',
			'select' => 'select',
		),
		'char' => array(
			'text'     => 'text',
			'textarea' => 'textarea',
		),
		'varchar' => array(
			'text'     => 'text',
			'textarea' => 'textarea',
		),
		'text' => array(
			'textarea' => 'textarea',
			'text'     => 'text',
		),
		'enum' => array(
			'select' => 'select',
			'radio'  => 'radio',
		),
		'date' => array(
			'select' => 'select',
			'text'     => 'text',
		),
		'timestamp' => array(
		),
	),

);