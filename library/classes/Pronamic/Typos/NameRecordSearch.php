<?php

namespace Pronamic\Typos;

class NameRecordSearch {
	public $platformId;

	public $encodingId;

	public $languageId;

	public function __construct($platformId, $encodingId, $languageId) {
		$this->platformId = $platformId;
		$this->encodingId = $encodingId;
		$this->languageId = $languageId;
	}
}