<?php

namespace Crude;

/**
 * Table class
 *
 * Manages sessions variable with table information.
 */
class Table {

	/**
	 * Return a list of table name in the configured database.
	 *
	 * @return  array    the table list as: array('table_name' => 'table_class')
	 */
	public function get_listing()
	{
		$rval = array();
		$table_prefix = Table::get('crud.TBL_PREFIX', false);

		$tables = \DB::list_tables();

		foreach ($tables as $table_name)
		{
			$table_class = 'bold';
			if ( ! $table_prefix and strpos($table_name, '_') !== false)
			{
				$table_class = 'notice_text';
			}
			if ($table_prefix and strpos($table_name, $table_prefix) === false)
			{
				$table_class = 'disabled_text';
			}

			$rval[$table_name] = $table_class;
		}

		return $rval;
	}

	/**
	 * Returns all table data from the 'crud' session var. Creates new data if $load = true.
	 *
	 * @param   string   $table_name
	 * @param   boolean  set to true to load data
	 * @return  array    the table data
	 */
	public static function get_all_data($load = false)
	{
		// retrive data from session
		$data = \Session::get('crud');

		if (isset($data['TBL_NAME']) and $load)
		{
			// remove prefix from table name
			$tbl_name = $data['TBL_NAME'];
			if ($tbl_prefix = $data['TBL_PREFIX'])
			{
				$tbl_name = str_replace($tbl_prefix, '', $tbl_name);
			}

			$data['TBL_SINGULAR']      = \Inflector::singularize($tbl_name);
			$data['TBL_PLURAL']        = \Inflector::pluralize($tbl_name);
			$data['TBL_UCSINGULAR']    = \Inflector::classify($tbl_name);
			$data['TBL_UCPLURAL']      = \Inflector::pluralize(\Inflector::classify($tbl_name));
			$data['COLUMNS']           = self::create_column_array($tbl_name);
			$data['TBL_PK']            = \Session::get('tmp.tbl_pk');
			$data['TBL_COLUMN_PREFIX'] = \Session::get('tmp.column_prefix');

			// set data
			\Session::set('crud', $data);
		}

		return $data;
	}

	/**
	 * Recursively updates elements in 'crud' session variable with values in input array.
	 *
	 * @param   array   $input
	 * @return  void
	 */
	public static function update_data($input)
	{
		// fetch session data
		$data = \Session::get('crud');

		// replace values in data with input
		$data = array_replace_recursive($data, $input);

		// save session var
		\Session::set('crud', $data);
	}

	/**
	 * Resets 'crud' data to its default state
	 *
	 * @return  void
	 */
	public static function reset_data()
	{
		\Session::destroy();
		\Session::create();

		\Session::set('crud', array(
			'DB_NAME'           => \Config::get('db.'.\Config::get('environment').'.connection.database'),
			'DB_TYPE'           => \Config::get('db.'.\Config::get('environment').'.type'),
			'TBL_PREFIX'        => \Config::get('db.'.\Config::get('environment').'.table_prefix'),
			'TBL_NAME'          => null,
			'TBL_PK'            => null,
			'TBL_SINGULAR'      => null,
			'TBL_PLURAL'        => null,
			'TBL_UCSINGULAR'    => null,
			'TBL_UCPLURAL'      => null,
			'TBL_COLUMN_PREFIX' => null,
			'TBL_SORT_COLUMN'   => null,
			'COLUMNS'           => null,
			'NAMESPACE'         => '',
			'STENCIL_NAME'      => \Config::get('crude.default_stencil'),
			'STENCIL_DESC'      => Stencil::get(\Config::get('crude.default_stencil'), 'desc'),
			'STENCIL_OPTIONS'   => Stencil::get_options(),
		));
	}

	/**
	 * Returns an array of table columns suitable for this system and returns it.
	 *
	 * @param    string   table_name
	 * @return   array    the column array
	 */
	public static function create_column_array($table_name)
	{
		// init
		$i = 1;
		$tmp = array();
		$rval = array();

		// store detected column prefix in temporary session var
		$tmp['column_prefix'] = self::get_column_prefix($table_name);

		// fetch the table columns
		$columns = \DB::list_columns($table_name);

		foreach ($columns as $name => $data)
		{
			// primary key
			if ($data['key'] == 'PRI')
			{
				// store primary key in temporary session var
				$tmp['tbl_pk'] = $data['name'];
			}

			$rval[$name] = array(
				'NAME'       => $name,
				'HUMANIZE'   => \Inflector::humanize(str_replace($tmp['column_prefix'], '', $name)),
				'TYPE'       => $data['data_type'],
				'CONSTRAINT' => isset($data['display']) ? $data['display'] : '',
				'OPTIONS'    => isset($data['options']) ? self::format_options_array($data['options']) : null,
				'KEY'        => $data['key'],
				'MIN'        => (isset($data['min'])) ? (int) $data['min'] : 0,
				'MAX'        => self::_get_max($data),
				'DEFAULT'    => $data['default'],
				'OMISSIONS'  => array(
					'MODEL'   => '0',
					'LISTING' => '0',
					'FORM'    => $data['key'] == 'PRI' ? '1' : '0',
				),
				'INPUT'      => array(
					'OPTIONS'  => self::_get_input_options($data['data_type']),
					'SELECTED' => self::_get_input_options($data['data_type'], true)
				),
				'VALIDATION' => array(
					'REQUIRED' => '0',
				),
				'PAD'        => false,
			);

			$i++;
		}

		\Session::set('tmp', $tmp);

		return $rval;
	}

	/**
	 * Set SORT BY column for the listing to the first column not omitted from the listing.
	 *
	 * @return  void
	 */
	public static function set_sort_by_column()
	{
		$sort_column = null;
		$data = \Session::get('crud');

		foreach ($data['COLUMNS'] as $key => $column)
		{
			if (! $column['OMISSIONS']['LISTING'])
			{
				$sort_column = $key;
				break;
			}
		}

		// set the sort by column
		$data['TBL_SORT_COLUMN'] = $sort_column;
		\Session::set('crud', $data);
	}

	/**
	 * Sets a string padded with spaces for each column to make the code line up.
	 *
	 * @return  void
	 */
	public static function set_column_pad()
	{
		// get maximum length of column names
		$max_length = 0;
		$data = \Session::get('crud');

		foreach ($data['COLUMNS'] as $key => $column)
		{
			$len = strlen($column['NAME']);
			if ($len > $max_length)
			{
				$max_length = $len;
			}
		}

		// create pad based on difference of column name length and maximum column name length
		foreach ($data['COLUMNS'] as $key => $column)
		{
			$data['COLUMNS'][$key]['PAD'] = str_repeat(' ', $max_length - strlen($column['NAME']) + 1);
		}

		\Session::set('crud', $data);
	}

	/**
	 * Returns the detected column prefix of a table.
	 *
	 * @param    string   table_name
	 * @return   string   the detected column prefix or an empty string
	 */
	public static function get_column_prefix($table_name)
	{
		$columns = \DB::list_columns($table_name);

		// build an array of table column properties
		$prefixes = array();

		foreach ($columns as $key => $column)
		{
			// explode by '_' and store the first element
			$p = explode('_', $key);
			$prefixes[$p[0]] = $p[0].'_';
		}

		// we have detected the column prefix if only one element created. i hope
		if (count($prefixes) == 1)
		{
			return $p[0].'_';
		}

		return '';
	}

	/**
	 * Returns an array for use with HTML select options.
	 *
	 * @param    array  the array to format.
	 * @return   array  the formatted array
	 */
	public static function format_options_array($options)
	{
		$rval = array();

		foreach ($options as $option)
		{
			$rval[$option] = \Inflector::humanize($option);
		}

		return $rval;
	}

	/**
	 * Returns an array of input options available for a data type. This can be
	 * configured in modules/crude/config/crude.php.
	 *
	 * @param    string        data type
	 * @param    boolean       if true, will return only the default option
	 * @return   array|string  the input options array or string which is the default option
	 */
	private static function _get_input_options($data_type, $return_default = false)
	{
		$input_options = \Config::get('crude.input_options');

		$options = array_key_exists($data_type, $input_options) ? $input_options[$data_type] : array();

		if ($return_default and ! empty($options))
		{
			return array_shift($options);
		}

		return $options;
	}

	/**
	 * Returns an integer that is the maximum character length for string db types.
	 *
	 * @param    string   column
	 * @return   array    the input options array
	 */
	private static function _get_max($column)
	{
		if (isset($column['character_maximum_length']))
		{
			return (int) $column['character_maximum_length'];
		}
	}

	/**
	 * Simply a wrapper for Session::get().
	 *
	 * @param    string   key
	 * @return   mixed    value of variable
	 */
	public static function get($key)
	{
		return \Session::get($key);
	}

}