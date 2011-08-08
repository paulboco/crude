<?php

// relative path to views folder
$stencil_path = '.'.DS.'..'.DS.basename(STENCILSPATH).DS;

// auto-detect name of this stencil... it's just the directory name ;)
$stencil_name = basename(__DIR__);

return array(

	'name' => $stencil_name,

	'desc' => 'Similar to the default_orm template except with added validation.',

	// set links to omit from the table listing
	'table_link_omissions' => array(
		//'Wizard',
		//'Express',
	),

	// set URIs to omit from the breadcrumbs
	'breadcrumb_ommissions' => array(
		//'namespace',
		//'model',
		//'listing',
		//'form',
		//'input',
		//'validation',
		//'foreign_keys', // not yet implemented
	),

	// display the download button in finish?
	'enable_download' => true,

	// the files that will be generated
	'files' => array(
		'controller' => array(
			'output_path'   => 'classes'.DS.'controller'.DS.':PLURAL.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'classes'.DS.'controller'.DS.'plural',
		),
		'model' => array(
			'output_path'   => 'classes'.DS.'model'.DS.':SINGULAR.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'classes'.DS.'model'.DS.'singular',
		),
		'create' => array(
			'output_path'   => 'views'.DS.':PLURAL'.DS.'create.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'plural'.DS.'create',
		),
		'edit' => array(
			'output_path'   => 'views'.DS.':PLURAL'.DS.'edit.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'plural'.DS.'edit',
		),
		'_form' => array(
			'output_path'   => 'views'.DS.':PLURAL'.DS.'_form.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'plural'.DS.'_form',
		),
		'index' => array(
			'output_path'   => 'views'.DS.':PLURAL'.DS.'index.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'plural'.DS.'index',
		),
		'view' => array(
			'output_path'   => 'views'.DS.':PLURAL'.DS.'view.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'plural'.DS.'view',
		),
		'template' => array(
			'output_path'   => 'views'.DS.'template.php',
			'stencil_path' => $stencil_path.$stencil_name.DS.'views'.DS.'template',
		),
	),

);