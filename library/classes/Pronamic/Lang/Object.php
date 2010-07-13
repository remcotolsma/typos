<?php

namespace Pronamic\Lang;

class Object {
	/**
	 * Check if the specified object is an instance of the specified class and 
	 * return the object if true
	 * 
	 * @param mixed $object
	 * @param mixed $class
	 * @return the object or null
	 */
	public static function getAs($object, $class) {
		if($object instanceof $class) {
			return $object;
		} else {
			return null;
		}
	}
}
