<?php

namespace Crude;

/**
 * Class controller CRUD
 */
class Controller_CRUD extends Controller_Base {

	/**
	 * Action error
	 *
	 * Displays initialization errors.
	 *
	 */
	public function action_error()
	{
		// get errors
		$this->template->set_global('errors', Error::get_all(), false);

		$this->template->title = 'CRUD';
		$this->template->content = \View::factory('crud/error');
	}

	/**
	 * Action tables
	 *
	 * Lists tables in the currently configured database.
	 *
	 */
	public function action_tables()
	{
		// reset data
		Table::reset_data();

		// get post input
		if ($input = \Input::post(null))
		{
			// update stencil selection via post
			if (\Input::post('change_stencil'))
			{
				$input['STENCIL_NAME'] = \Input::post('STENCIL_NAME');
				$input['STENCIL_DESC'] = Stencil::get(\Input::post('STENCIL_NAME'), 'desc');

				Table::update_data($input);
			}
		}

		// set global stencil template vars
		$this->template->set_global('stencil', array(
			'data' => Stencil::get(Table::get('crud.STENCIL_NAME')),
		));

		// get list of tables in currently configured database
		$this->template->set_global('tables', Table::get_listing());

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action namespace
	 *
	 * Allows input of optional namespace.
	 *
	 */
	public function action_namespace($table_name, $load = false)
	{
		// update data array with selected table name
		Table::update_data(array('TBL_NAME' => $table_name), true);

		// populate data array
		$data = Table::get_all_data($load);

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Restart')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action model
	 *
	 * Lists columns in the selected table and allows selection of columns
	 * to OMIT from the model.
	 *
	 */
	public function action_model()
	{
		// populate data array
		$data = Table::get_all_data();

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Back')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action listing
	 *
	 * Lists columns in the selected table and allows selection of columns
	 * to OMIT from the listing.
	 *
	 */
	public function action_listing()
	{
		// populate data array
		$data = Table::get_all_data();

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Back')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action form
	 *
	 * Lists columns in the selected table and allows selection of columns
	 * to OMIT from the form.
	 *
	 */
	public function action_form()
	{
		// populate data array
		$data = Table::get_all_data();

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Back')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action input
	 *
	 * Change the label text if necessary and choose which HTML input type
	 * to use for each column.
	 *
	 */
	public function action_input()
	{
		// populate data array
		$data = Table::get_all_data();

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Back')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action validation
	 *
	 * Allows selection of validation types for input fields.
	 *
	 */
	public function action_validation()
	{
		// populate data array
		$data = Table::get_all_data();

		if ($submit = \Input::post('submit'))
		{
			// update table data via post and redirect
			Table::update_data(\Input::post(null));

			// choose redirect action
			if ($submit == 'Back')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'prev');
			}

			if ($submit == 'Next')
			{
				$action = self::_breadcrumbs(\Request::active()->action, 'next');
			}

			\Response::redirect($action);
		}

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Action finish
	 *
	 * Finish the CRUD operation.
	 * Select the stencil and download zip.
	 *
	 */
	public function action_finish($table_name, $load = false)
	{
		// set table name in data array
		Table::update_data(array('TBL_NAME' => $table_name), true);

		// create data if none exists
		// this means the user clicked the 'express' generation option in action_tables
		if ($load)
		{
			Table::get_all_data($load);
		}

		// set padding for each column
		Table::set_column_pad();

		// use first item not ommited from the listing for sort order
		Table::set_sort_by_column();

		// get post input
		if ($input = \Input::post(null))
		{
			// write files to output directory
			if (\Input::post('submit') == 'Download Zip')
			{
				if ( ! File::download_zip())
				{
					$msg = array('modal_id' => 'modal_error', 'text' => Error::get_all());
					\Session::set_flash('modal_msg', $msg);
				}
			}

			// redirect
			\Response::redirect(self::_breadcrumbs(\Request::active()->action, 'prev'));
		}

		// set global stencil template vars
		$this->template->set_global('stencil', array(
			'data' => Stencil::get(Table::get('crud.STENCIL_NAME')),
		));

		// set common template vars
		self::_set_template_vars($this->template);
	}

	/**
	 * Set common template variables.
	 */
	public static function _set_template_vars($template)
	{
		// breadcrumbs
		$template->set_global('breadcrumbs',  self::_breadcrumbs(), false);

		// set global template vars with table data
		$data = Table::get_all_data();
		foreach ($data as $key => $value)
		{
			$template->set_global($key, $value);
		}

		$template->title = 'CRUD';
		$template->content = \View::factory('crud/'.\Request::active()->action, $data);
	}

	/**
	 * Breadcrumbs
	 *
	 * @param   string   key of specific element to return or null for all elements
	 * @param   string   either 'next' or 'prev' to return the respective uri
	 * @return  mixed
	 */
	private static function _breadcrumbs($key = null, $direction = null)
	{
		// define breadcrumbs
		$breadcrumbs = array(
			'tables'     => array('Tables'     => 'crude/crud/tables'),
			'namespace'  => array('Namespace'  => 'crude/crud/namespace/'.Table::get('crud.TBL_NAME', '')),
			'model'      => array('Model'      => 'crude/crud/model'),
			'listing'    => array('Listing'    => 'crude/crud/listing'),
			'form'       => array('Form'       => 'crude/crud/form'),
			'input'      => array('Input'      => 'crude/crud/input'),
			'validation' => array('Validation' => 'crude/crud/validation'),
			'finish'     => array('Finish'     => 'crude/crud/finish/'.Table::get('crud.TBL_NAME', '')),
		);

		// get keys to be ommitted from breadcrumbs
		// this is set in config/crude.php
		$omit = array_flip(Stencil::get(Table::get('crud.STENCIL_NAME'), 'breadcrumb_ommissions'));
		$breadcrumbs = array_diff_key($breadcrumbs, $omit);

		if ($direction)
		{
			$lastkey = array_pop(array_keys($breadcrumbs));

			reset($breadcrumbs);

			// set array pointer at matching element
			while (list($key, $val) = each($breadcrumbs))
			{
				if ($key == \Request::active()->action)
				{
					break;
				}
			}

			// return previous uri
			if ($direction == 'prev')
			{
				// set array pointer to end if last element
				$key == $lastkey ? end($breadcrumbs) : prev($breadcrumbs);

				prev($breadcrumbs);
				return current(current($breadcrumbs));
			}

			// return next uri
			if ($direction == 'next')
			{
				return current(current($breadcrumbs));
			}
		}

		return $key ? current($breadcrumbs[$key]) : $breadcrumbs;
	}

}