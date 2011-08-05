<?php

namespace Crude;

// define Crude paths
define('CRUDEPATH',    APPPATH.'modules'.DS.'crude'.DS);
define('TMPPATH',      APPPATH.'tmp'.DS);
define('STENCILSPATH', CRUDEPATH.'stencils'.DS);

// define msg constants
const CRUDE_FUEL_ERR = 'Fuel Error';
const CRUDE_NOTICE   = 'Notice';
const CRUDE_WARNING  = 'Warning';
const CRUDE_ERROR    = 'Error';
const CRUDE_SOLUTION = 'Solution';
const CRUDE_SUCCESS  = 'Success';

class Controller_Base extends \Controller {

	/**
	* @var string page template
	*/
	public $template = 'template';

	/**
	* @var boolean auto render template
	**/
	public $auto_render = true;

	/**
	* @var string site name
	*/
	public $site_name = 'Crude';

	// Load the template and create the $this->template object
	public function before()
	{
		// load the template
		$this->template = \View::factory('template');

		// init CRUD controller
		if (\Request::active()->controller == 'crud')
		{
			// redirect to crud/error if errors were found
			if ( ! Init::all() and \Request::active()->action != 'error')
			{
				\Response::redirect('crude/crud/error');
			}
		}

		$this->template->set('modal_msg', \Session::get_flash('modal_msg'));
		$this->template->set('site_name', $this->site_name);

		return parent::before();
	}

	// After controller method has run, output the template
	public function after()
	{
		if ($this->auto_render === true)
		{
			$this->response->body($this->template);
		}

		return parent::after();
	}

}