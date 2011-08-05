<?php

namespace Crude;

/**
 * Initialize Crude CRUD requirements
 */
class Init {

	/**
	 * Call all methods.
	 *
	 * @return  bool     returns true if all methods successfully run or false on any failure.
	 */
	public static function all()
	{
		// config
		if ( ! self::config())
		{
			return false;
		}

		// database
		if ( ! self::database())
		{
			return false;
		}

		// output_dir
		if ( ! self::output_dir())
		{
			return false;
		}

		// stencils
		if ( ! self::stencils())
		{
			return false;
		}

		return true;
	}

	/**
	 * Load crude configuration.
	 *
	 * @return  bool  returns true on success or sets error messages and returns false.
	 */
	public static function config()
	{
		// load crude configuration
		$config_path = CRUDEPATH.'config'.DS.'crude.php';

		if ( ! File::file_exists($config_path))
		{
			Error::set(CRUDE_ERROR, 'Crude config file was not found');
			Error::set(CRUDE_SOLUTION, 'Check that <code>CRUDEPATH'.DS.'config'.DS.'crude.php</code> exists, is readable and is properly formatted');
			return false;
		}
		else
		{
			// file must be readable
			if ( ! is_readable($config_path))
			{
				Error::set(CRUDE_ERROR, 'Crude config file is not readable');
				Error::set(CRUDE_SOLUTION, 'Check that <code>CRUDEPATH'.DS.'config'.DS.'crude.php</code> is readable');
				return false;
			}

			// file size must be greater than 700 bytes
			$filesize = filesize($config_path);
			if ($filesize < 700)
			{
				Error::set(CRUDE_ERROR, 'Crude config file appears to be corrupt. File size less than 700 bytes. '.$filesize.' bytes found');
				Error::set(CRUDE_SOLUTION, 'Check that <code>CRUDEPATH'.DS.'config'.DS.'crude.php</code> is properly formatted');
				return false;
			}

			// load crude configuration
			\Config::load('crude', true);
		}

		return true;
	}

	/**
	 * Load database configuration.
	 *
	 * @return  bool  returns true on success or sets error messages and returns false.
	 */
	public static function database()
	{
		// load database config
		if ( ! \Config::load('db', true))
		{
			Error::set(CRUDE_ERROR, 'Fuel database configuration file not found.');
			Error::set(CRUDE_SOLUTION, 'Check that the database configuration file <code>APPPATH'.DS.'config'.DS.'db.php</code> exists and is properly formatted. See '.\Html::anchor('http://fuelphp.com/docs/classes/database/introduction.html', 'Fuel documentation', array('target' => '_blank')));
			return false;
		}

		// check database connection. Thanks, Jelmer.
		try
		{
			@\Database_Connection::instance()->connect();
		}
		catch (\Database_Exception $e)
		{
			// can't seem to properly catch database authentication errors
			// hack to trap authentication error. there are probably other errors involved here.
			$msg = $e->getMessage();
			if (empty($msg))
			{
				$msg = 'Access to database <code>'.\Config::get('db.'.\Config::get('environment').'.connection.database').'</code> was denied.';
			}
			$msg = str_replace('\'', '"', $msg);
			Error::set(CRUDE_FUEL_ERR, $msg);
			Error::set(CRUDE_SOLUTION, 'Check that the database configuration file <code>APPPATH'.DS.'config'.DS.'db.php</code> contains the correct information to connect to your database. See '.\Html::anchor('http://fuelphp.com/docs/classes/database/introduction.html', 'Fuel documentation', array('target' => '_blank')));
			return false;
		}

		// check that tables exist in the database
		$tables = \DB::list_tables();
		if (empty($tables))
		{
			Error::set(CRUDE_ERROR, 'No tables found in database <code>'.\Config::get('db.'.\Config::get('environment').'.connection.database').'.</code>');
			Error::set(CRUDE_SOLUTION, 'There must be at least one table in the configured database for Crude CRUD to work.');
			return false;
		}

		return true;
	}

	/**
	 * Check for existance of output directory.
	 *
	 * @return  bool  returns true on success or sets error messages and returns false.
	 */
	public static function output_dir()
	{
		if ( ! File::dir_exists(TMPPATH))
		{
			Error::set(CRUDE_ERROR, 'Fuel temporary directory was not found');
			Error::set(CRUDE_SOLUTION, 'Check that directory <code>'.TMPPATH.'</code> exists and is writable by the webserver');
			return false;
		}
		else
		{
			// file must be readable
			if ( ! is_writable(TMPPATH))
			{
				Error::set(CRUDE_ERROR, 'Fuel temporary directory is not writable');
				Error::set(CRUDE_SOLUTION, 'Check that directory <code>'.TMPPATH.'</code> is writable by the webserver');
				return false;
			}
		}

		return true;
	}

	/**
	 * Check for existance of stencils.
	 *
	 * @return  bool  returns true on success or sets error messages and returns false.
	 */
	public static function stencils()
	{
		if ( ! File::dir_exists(STENCILSPATH))
		{
			Error::set(CRUDE_ERROR, 'Crude stencils directory not found.');
			Error::set(CRUDE_SOLUTION, 'Check that the directory <code>'.STENCILSPATH.'</code> exists and contains at minimum the default stencil.');
			return false;
		}
		else
		{
			// check that the 'default' stencil exists in the stencils dir
			if ( ! Stencil::get(\Config::get('crude.default_stencil')))
			{
				Error::set(CRUDE_ERROR, 'Default stencil not found in the stencils directory.');
				Error::set(CRUDE_SOLUTION, 'The directory <code>'.STENCILSPATH.'</code> must contain at minimum the default stencil.');
				return false;
			}
		}

		return true;
	}

}