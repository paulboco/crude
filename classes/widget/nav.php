<?php

namespace Crude;

class Widget_Nav {

	/**
	 * Render the navigation.
	 */
	public static function render($nav_config, $seperator = '', $tag = null, $config_file = 'nav')
	{
		// get nav configuration
		\Config::load($config_file);
		$nav = \Config::get($nav_config);

		if ( ! $nav)
		{
			throw new \Fuel_Exception('Nav configuration not found in config/'.$config_file.'.php');
			return false;
		}

		// build wrapper tags for anchor
		if ($tag)
		{
			$_ot = PHP_EOL."<{$tag}>";
			$_ct = "</{$tag}>\n";
		}
		else
		{
			$_ot = PHP_EOL;
			$_ct = '';
		}

		$count = 0;
		$output = '';
		foreach($nav['items'] as $label => $item)
		{
			// set the seperator
			$_sp = ($count) ? $seperator : '';

			// set class as current item when a uri segment matches any configured trigger
			$class = (static::match_trigger($item['triggers'])) ? array('class' => $nav['current_class']) : null;

			// see if item is dependent upon auth status
			if (isset($item['auth']))
			{
				// check that auth package has been loaded
				$array = \Config::get('always_load.packages', array());
				if ( ! in_array('auth', $array))
				{
					throw new \Fuel_Exception('Can not check for Auth when Auth package is not loaded in config/'.$config_file.'.php');
					return false;
				}

				// item requires logged in status
				if ($item['auth'] and \Auth::check())
				{
					if (isset($item['group']))
					{
						// get user's group
						$group = \Auth::instance()->get_user_groups();
						$group = (int)$group[0][1];

						if ($item['group'] <= $group)
						{
							// string replacements go here
							$label = str_replace('user_screen_name:', \Auth::instance()->get_user_screen_name(), $label);
							$output .= $_sp.$_ot.Html::anchor($item['url'], $label, $class).$_ct;
							$count++;
						}
					}
					else
					{
						// string replacements go here
						$label = str_replace('user_screen_name:', \Auth::instance()->get_user_screen_name(), $label);
						$output .= $_sp.$_ot.Html::anchor($item['url'], $label, $class).$_ct;
						$count++;
					}
				}

				// item requires logged out status
				if ( ! $item['auth'] and ! \Auth::check())
				{
					$output .= $_sp.$_ot.\Html::anchor($item['url'], $label, $class).$_ct;
					$count++;
				}
			}
			else
			{
				$output .= $_sp.$_ot.\Html::anchor($item['url'], $label, $class).$_ct;
				$count++;
			}
		}

		return $output.PHP_EOL;
	}

	/**
	 * Match configured triggers with current URI.
	 */
	private static function match_trigger($triggers)
	{
		// get uri segments
		$current_uri = \Uri::segments();

		// try to match a trigger with the current uri segments
		foreach($triggers as $trigger)
		{
			// create array of this trigger
			$trigger_uri = explode('/', $trigger);

			// slice trigger array at the wildcard (*)
			$pos = array_search('*', $trigger_uri);
			if ($pos !== false)
			{
				// slice arrays to equal size
				$current_uri = array_slice($current_uri, 0, $pos);
				$trigger_uri = array_slice($trigger_uri, 0, $pos);
			}

			// compare arrays
			if ($trigger_uri == $current_uri)
			{
				return true;
			}
		}

		return false;
	}

}