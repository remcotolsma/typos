<?php

namespace Pronamic\Typos;

/**
 * Title: TrueType font table directory entry
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class TableDirectoryEntryReader {
	/**
	 * Read the table directory entry reader
	 * 
	 * @param Stream $resource
	 * @return TableDirectoryEntry
	 */
	public static function read(Stream $resource) {
		$entry = new TableDirectoryEntry();

		$entry->setTag($resource->readULong());
		$entry->setCheckSum($resource->readULong());
		$entry->setOffset($resource->readULong());
		$entry->setLength($resource->readULong());

		return $entry;
	}
}
