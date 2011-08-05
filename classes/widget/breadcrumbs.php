<?php

namespace Crude;

class Widget_Breadcrumbs {

	public static function render($breadcrumbs, $seperator = ' > ', $class_inactive = 'inactive')
	{
		$arr = array();

		// build breadcrumb HTML
		foreach ($breadcrumbs as $name => $pair)
		{
			$label = key($pair);
			$uri   = current($pair);

			// set class to inactive if this breadcrumb is the current request action
			if (strpos($uri, \Request::active()->action) !== false)
			{
				$arr[] = PHP_EOL.'<span class="'.$class_inactive.'">'.$label.'</span>';
				break;
			}
			else
			{
				$arr[] = PHP_EOL.\Html::anchor($uri, $label);
			}
		}

		return implode($arr, $seperator);
	}

}