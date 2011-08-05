<?php

namespace Crude;

/**
 * Crude's extension of Fuel's File class.
 */
class File extends \File {

	/**
	 * Download generated zip file.
	 *
	 * @return  exit()
	 */
	public static function download_zip()
	{
		// get all table data
		$data = Table::get_all_data();

		// build file path
		// use database__table for filename
		$zippath  = \Config::get('crude.crudzip_path');
		$filename = $data['DB_NAME'].'__'.$data['TBL_NAME'].'.zip';

		// create tmp/crude if non-existant
		if ( ! self::dir_exists($zippath))
		{
			self::create_dir(dirname($zippath), basename($zippath), 0755);
		}

		// delete tmp file if it exists
		if (self::file_exists($zippath.$filename))
		{
			self::delete($zippath.$filename);
		}

		// load the stencil configuration data
		if ( ! $stencil_data = Stencil::get($data['STENCIL_NAME']))
		{
			Error::set(CRUDE_ERROR, 'Could not load the selected stencil');
			Error::set(CRUDE_SOLUTION, 'Check that directory &quot;CRUDEPATH'.DS.'stencils&quot; exists and contains stencil folder &quot;'.$data['STENCIL_NAME'].'&quot;');
			return false;
		}

		// increase script timeout value
		ini_set("max_execution_time", 300);

		// create zip object
		$zip = new \ZipArchive();

		// open archive
		if ($zip->open($zippath.$filename, \ZIPARCHIVE::CREATE) !== TRUE)
		{
			die ("Could not open archive");
		}

		// build the archive
		foreach($stencil_data['files'] as $key => $file)
		{
			$data['file_header'] = Stencil::file_header($file['output_path'], $data['TABLE_NAME'], $data['STENCIL_NAME']);
			$zip->addFromString($file['output_path'], \View::factory($file['stencil_path'], $data)) or die ("ERROR: Could not add file: $key");
		}

		$zip->close();

		self::download($zippath.$filename);
	}

	/**
	 * File exists and is a file
	 *
	 * @param   string   path to the file
	 * @return  bool     returns true if file exists and is a file
	 */
	public static function file_exists($path)
	{
		return file_exists($path) and is_file($path);
	}

	/**
	 * Directory exists and is a directory
	 *
	 * @param   string   path to the directory
	 * @return  bool     returns true if directory found and is a directory
	 */
	public static function dir_exists($path)
	{
		return file_exists($path) and is_dir($path);
	}


}