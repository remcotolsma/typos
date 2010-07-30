<?php

namespace Pronamic\Typos;

/**
 * Title: Table
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
abstract class Table {
	/**
	 * A indicator for the name table
	 * 
	 * @var int
	 */
	const TABLE_NAME = 0x6E616D65;

	/**
	 * A indicator for the head table
	 * 
	 * @var int
	 */
	const TABLE_HEAD = 0x68656164;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes a font table
	 */
	public function __construct() {
		
	}
}
