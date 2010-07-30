<?php

namespace Pronamic\Typos\IO;

use Pronamic\Typos;

use Pronamic\Typos\HeadTable;
use Pronamic\Typos\TableDirectoryEntry;

/**
 * Title: Head table reader
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class HeadTableReader {
	/**
	 * Read the name table
	 * 
	 * @param Stream $resource
	 * @param TableDirectoryEntry $directoryEntry
	 */
	public static function read(Stream $resource, TableDirectoryEntry $directoryEntry) {
		$headTable = new HeadTable();

		$headTable->setVersion($resource->readFixed());
		$headTable->setFontRevision($resource->readFixed());
		$headTable->setCheckSumAdjustment($resource->readULong());
		$headTable->setMagicNumber($resource->readULong());
		$headTable->setFlags($resource->readUShort());
		$headTable->setUnitsPerEm($resource->readUShort());
		$headTable->setCreated($resource->readLongDateTime());

		return $headTable;
	}
}
