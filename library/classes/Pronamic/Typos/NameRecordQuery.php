<?php

namespace Pronamic\Typos;

/**
 * Title: Name record query object
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class NameRecordQuery {
	/**
	 * Platform indicator id
	 * 
	 * @var int
	 */
	public $platformId;

	/**
	 * Encoding indicator id
	 * 
	 * @var int
	 */
	public $encodingId;

	/**
	 * Language indicator id
	 * 
	 * @var int
	 */
	public $languageId;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes an name record query
	 * 
	 * @param int $platformId platform id
	 * @param int $encodingId encoding id
	 * @param int $languageId language id
	 */
	public function __construct($platformId, $encodingId, $languageId) {
		$this->platformId = $platformId;
		$this->encodingId = $encodingId;
		$this->languageId = $languageId;
	}
}
