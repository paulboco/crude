<?php

/**
 * Crude configuration file
 *
 * @package     Fuel
 * @version     1.0
 * @author      Fuel Development Team
 * @license     MIT License
 * @copyright   2011 Fuel Development Team
 * @link        http://fuelphp.com
 */

return array (

	'default_stencil'  => 'default_orm',
	'crudzip_path'     => TMPPATH.'crude'.DS,

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
			'select 3' => 'select 3',
			'text'     => 'text',
		),
		'timestamp' => array(
		),
	),

);

/* End of file temp.php */