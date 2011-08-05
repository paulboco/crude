<?php

namespace Crude;

class Debug {

	private static $colors = array(
		'#9F9',
		'#6AF',
		'#F88',
		'#FF8',
		'#0FA',
		'#0FF',
		'#FC4',
		'#CF5',
		'#FAF',
		'#DDD',
	);

	private static $color = -1;

	/**
	 * Output a variable with print_r wrapped in pre tags.
	 * @param $var   mixed the variable to print_r
	 * @param $color int   the border and text color
	 */
	public static function print_r($var, $color = null)
	{
		$color = self::_set_color($color);
		$color = self::$colors[$color];

		echo "<pre style=\"width:auto;background-color:{$color};border:solid 1px #333;color:#333;font-size:small;font-family:monospace;line-height:15px;padding:10px;text-align:left\">";
		print_r($var);
		echo '</pre>';
	}

	/**
	 * Output a variable with var_export wrapped in pre tags.
	 * @param $var   mixed the variable to export
	 * @param $color int   the border and text color
	 */
	public static function vars($var, $color = null, $show_callee = true)
	{
		$color = self::_set_color($color);
		$color = self::$colors[$color];

		list($callee) = debug_backtrace();

		echo "<pre style='width:auto;background-color:{$color};border:solid 1px #333;color:#333;font-size:normal;font-family:monospace;line-height:15px;padding:10px;text-align:left;'>";
		if ($show_callee)
		{
			echo '<fieldset><legend style="border-radius:7px;font-size:normal;font-weight:bold;padding:5px;background:rgba(0,0,0,0.1);color:rgba(0,0,0,0.6);">'.$callee['file'].' @ line: '.$callee['line'].'</legend><br>';
		}
		var_export($var);
		echo '</fieldset></pre>';
	}

	/**
	 * Print_r the class methods of an object or class name.
	 * @param $var   mixed object or (string) class name
	 * @param $color int   the border and text color
	 */
	public static function methods($var)
	{
		self::vars(get_class_methods($var), 9);
	}

	private static function _set_color($color)
	{
		if ($color === null)
		{
			if (self::$color == 8)
				self::$color = -1;
			self::$color++;
			$color = self::$color;
		}
		return $color;
	}

	/**
	  * Debug Helper
	  *
	  * Outputs the given variable(s) with formatting and location
	  *
	  * @access        public
	  * @param        mixed    variables to be output
	  */
	public static function dump()
	{
		list($callee) = debug_backtrace();
		$arguments = func_get_args();
		$total_arguments = count($arguments);

		echo '<fieldset style="background: #fefefe !important; color:#000; border:2px red solid; padding:5px">';
		echo '<legend style="background:lightgrey; color:#000; padding:5px;">'.$callee['file'].' @ line: '.$callee['line'].'</legend><pre>';
		$i = 0;
		foreach ($arguments as $argument)
		{
			echo '<br/><strong>Debug #'.(++$i).' of '.$total_arguments.'</strong>: ';
			var_dump($argument);
		}

		echo "</pre>";
		echo "</fieldset>";
	}

}