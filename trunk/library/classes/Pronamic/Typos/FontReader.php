<?php

namespace Pronamic\Typos;

/**
 * Title: Font reader
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class FontReader {
	/**
	 * Read font from the specified resource
	 * 
	 * @param Stream $resource
	 */
	public static function read(Stream $resource) {
		// A font file begins at byte 0 with an offset table
		$resource->rewind();

		// Build up the font object
		$font = new Font();

		// Read the table directory
		$tableDirectory = TableDirectoryReader::read($resource);

		$font->setTableDirectory($tableDirectory);

		// Read name table
		$directoryEntry = $tableDirectory->getEntryByTag(Table::TABLE_NAME);

		if($directoryEntry != null) {
			$resource->seek($directoryEntry->getOffset());

			$nameTable = NameTableReader::read($resource, $directoryEntry);

			$font->nameTable = $nameTable;
		}

		return $font;
	}
}
