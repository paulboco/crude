<?php

namespace Crude;

class Widget_Minify {

	public static function render($css)
	{
		$css = preg_replace('#\s+#', ' ', $css);
		$css = preg_replace('#/\*.*?\*/#s', '', $css);
		$css = str_replace('; ', ';', $css);
		$css = str_replace(': ', ':', $css);
		$css = str_replace(' {', '{', $css);
		$css = str_replace('{ ', '{', $css);
		$css = str_replace(', ', ',', $css);
		$css = str_replace('} ', '}', $css);
		$css = str_replace(';}', '}', $css);

		return trim($css);
	}
}