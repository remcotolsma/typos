<?php

namespace Pronamic\Typos;

/**
 * Title: Name table reader
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class NameTableReader {
	/**
	 * Read the name table
	 * 
	 * @param Stream $resource
	 * @param TableDirectoryEntry $directoryEntry
	 */
	public static function read(Stream $resource, TableDirectoryEntry $directoryEntry) {
		$namingTable = new NameTable();

		$namingTable->setFormatSelector($resource->readUShort());
		$namingTable->setNumberNameRecords($resource->readUShort());
		$namingTable->setOffsetStartStringStorage($resource->readUShort());

		for ($i = 0; $i < $namingTable->getNumberNameRecords(); $i++) {
			$nameRecord = NameRecordReader::read($resource);

			$namingTable->addNameRecord($nameRecord);
		}

		foreach($namingTable->getNameRecords() as $nameRecord) {
			$offset = $directoryEntry->getOffset() + $namingTable->getOffsetStartStringStorage() + $nameRecord->getStringOffset();

			$resource->seek($offset);
	
			if($nameRecord->getStringLength() > 0) {
				// It's not likely that the string length is 0, the name record ought to be
				// unnecessary if that is the case. But to prefend an error on 
				// fread we do a check.

				// Fun to know: On a Windows platform fonts with an string length of 0 will 
				// not display a font icon in the explorer.

				$string = $resource->read($nameRecord->getStringLength());

				$nameRecord->setString($string);
			}
		}

		return $namingTable;
	}
}
