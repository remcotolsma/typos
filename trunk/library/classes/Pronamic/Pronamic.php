<?php

namespace Pronamic;

class Pronamic {
	public static function autoload($name) {
		$file = CLASS_PATH . DS . $name . '.php';

		if(is_file($file)) {
			include $file;
		}
	}
}