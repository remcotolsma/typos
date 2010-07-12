<?php

namespace Pronamic\Typos;

/**
 * Title: Utility class
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Util {
	/**
	 * Convert the specified ulong value to an string
	 * 
	 * @param int $value
	 * @return string
	 */
	public static function uLongToString($value) {
		$string = '';

		$string .= chr( ($value >> 24) & 0xFF );
		$string .= chr( ($value >> 16) & 0xFF );
		$string .= chr( ($value >>  8) & 0xFF );
		$string .= chr( ($value      ) & 0xFF );

		return $string;
	}
}
