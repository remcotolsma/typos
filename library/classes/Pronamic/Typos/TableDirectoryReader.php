<?php

namespace Pronamic\Typos;

/**
 * Title: Font table directory reader
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class TableDirectoryReader {
	/**
	 * Read the table directory
	 * 
	 * @param Stream $resource the resource to read from
	 * @return TableDirectory
	 */
	public static function read(Stream $resource) {
		$tableDirectory = new TableDirectory();

		$tableDirectory->setSfntVersion($resource->readFixed());
		$tableDirectory->setNumberTables($resource->readUShort());
		$tableDirectory->setSearchRange($resource->readUShort());
		$tableDirectory->setEntrySelector($resource->readUShort());
		$tableDirectory->setRangeShift($resource->readUShort());

		// This is followed at byte 12 by the table directory entries
		// Entries in the table directory are sorted in ascending order by tag
		for ($i = 0; $i < $tableDirectory->getNumberTables(); $i++) {
			$entry = TableDirectoryEntryReader::read($resource);
	
			$tableDirectory->addEntry($entry);
		}

		return $tableDirectory;
	}
}
