<?php

namespace Pronamic\Typos\IO;

use Pronamic\Typos\NameRecord;

/**
 * Title: TrueType font name record
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class NameRecordReader {
	/**
	 * Read an name record from the specified resource
	 * 
	 *  @param Stream $resource
	 *  @return NameRecord
	 */
	public static function read(Stream $resource) {
		$nameRecord = new NameRecord();

		$nameRecord->setPlatformId($resource->readUShort());
		$nameRecord->setPlatformEncodingId($resource->readUShort());
		$nameRecord->setLanguageId($resource->readUShort());
		$nameRecord->setNameId($resource->readUShort());
		$nameRecord->setStringLength($resource->readUShort());
		$nameRecord->setStringOffset($resource->readUShort());

		return $nameRecord;
	}
}
