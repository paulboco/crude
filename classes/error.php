<?php

namespace Crude;

class Error {

	/**
	 * The errors array.
	 */
	protected static $_errors = array();

	/**
	 * Set a Crude error.
	 */
	public static function set($level, $text)
	{
		self::$_errors[] = array(
			'level' => $level,
			'text'  => $text,
		);
	}

	/**
	 * Get all stored errors.
	 */
	public static function get_all()
	{
		return self::$_errors;
	}
}