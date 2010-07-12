<?php

namespace Pronamic\Typos;

/**
 * Title: Name table
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class NameTable extends Table {
	/**
	 * Indicator for the Apple Unicode platform
	 * 
	 * @var int
	 */
	const PLATFORM_APPLE_UNICODE = 0;

	/**
	 * Indicator for the Macintosh platform
	 * 
	 * @var int
	 */
	const PLATFORM_MACINTOSH = 1;

	/**
	 * Indicator for the ISO platform
	 * 
	 * @var int
	 */
	const PLATFORM_ISO = 2;

	/**
	 * Indicator for the Micrsoft platform
	 * 
	 * @var int
	 */
	const PLATFORM_MICROSOFT = 3;

	/**
	 * Indicator for an custom platform
	 * 
	 * @var int
	 */
	const PLATFORM_CUSTOM = 4;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Name ID indicator for a copyright notice
	 * 
	 * @var int
	 */
	const NAME_ID_COPYRIGHT = 0;

	/**
	 * Name ID indicator for a font family name
	 * 
	 * @var int
	 */
	const NAME_ID_FONT_FAMILY_NAME = 1;

	/**
	 * Name ID indicator for a font subfamily name; for purposes of definition,
	 * this is assumed to address style (italic, oblique) and weight (light,
	 * bold, black, etc.) only. A font with no particular differences in weight
	 * or style (e.g. medium weight, not italic and fsSelection bit 6 set) should
	 * have the string �Regular� stored in this position.
	 * 
	 * @var int
	 */
	const NAME_ID_FONT_SUB_FAMILY_NAME = 2;

	/**
	 * Name ID indicator for a unique font identifier
	 * 
	 * @var int
	 */
	const NAME_ID_UNIQUE_FONT_IDENTIFIER = 3;

	/**
	 * Name ID indicator for full font name; this should simply be a combination
	 * of strings 1 and 2. Exception: if string 2 is �Regular,� then use only
	 * string 1. This is the font name that Windows will expose to users.
	 * 
	 * @var int
	 */
	const NAME_ID_FULL_FONT_NAME = 4;

	/**
	 * Name ID indicator for a version string. In n.nn format.
	 * 
	 * @var int
	 */
	const NAME_ID_VERSION = 5;

	/**
	 * Name ID indicator for a postscript name for the font
	 * 
	 * @var int
	 */
	const NAME_ID_POSTSCRIPT_NAME = 6;

	/**
	 * Name ID indicator for a trademark; this is used to save any trademark notice/information for
	 * this font. Such information should be based on legal advice. This is
	 * distinctly separate from the copyright.
	 * 
	 * @var int
	 */
	const NAME_ID_TRADEMARK = 7;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Format selector (=0)
	 * 
	 * @var int
	 */
	private $formatSelector;

	/**
	 * The number of name records
	 * 
	 * @var int
	 */
	private $numberNameRecords;

	/**
	 * Offset to start of string storage (from start of table)
	 * 
	 * @var int
	 */
	private $offsetStartStringStorage;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The name records
	 * 
	 * @var array
	 */
	private $nameRecords;

	/**
	 * The name records
	 * 
	 * @var array
	 */
	private $strings;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initialize an naming table
	 */
	public function __construct() {
		$this->nameRecords = array();
		$this->strings = array();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the name of the specified platform ID
	 * 
	 * @return a string
	 */
	public static function getPlatformName($platformIndicator) {
		switch($platformIndicator) {
			case self::PLATFORM_APPLE_UNICODE:
				return 'Apple Unicode';
			case self::PLATFORM_MACINTOSH:
				return 'Macintosh';
			case self::PLATFORM_ISO:
				return 'ISO';
			case self::PLATFORM_MICROSOFT:
				return 'Microsoft';
			default:
				return 'Unknown';
		}
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the format selector
	 * 
	 * @return int
	 */
	public function getFormatSelector() {
		return $this->formatSelector;
	}

	/**
	 * Set the format selector
	 * 
	 * @param int $selector
	 */
	public function setFormatSelector($selector) {
		$this->formatSelector = $selector;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the number of name records
	 * 
	 * @return an intenger
	 */
	public function getNumberNameRecords() {
		return $this->numberNameRecords;
	}

	/**
	 * Set the number of name records
	 * 
	 * @param int $number
	 */
	public function setNumberNameRecords($number) {
		$this->numberNameRecords = $number;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the offset start string storage
	 * 
	 * @return an intenger
	 */
	public function getOffsetStartStringStorage() {
		return $this->offsetStartStringStorage;
	}

	/**
	 * Set the offset start string storage
	 * 
	 * @param int $offset
	 */
	public function setOffsetStartStringStorage($offset) {
		$this->offsetStartStringStorage = $offset;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Helper function to build strings array
	 * 
	 * @param array $array
	 * @param mixed $name
	 */
	private static function buildArray(array $array, $name) {
		if(!isset($array[$name])) {
			$array[$name] = array();
		}

		return $array[$name];
	} 

	/**
	 * Add the specified name record to this naming table
	 * 
	 * @param NameRecord $nameRecord
	 */
	public function addNameRecord(NameRecord $nameRecord) {
		$this->nameRecords[] = $nameRecord;

		// Strings are held by number, platform, encoding and
		// language. Strings are accessed as:
		// {'strings'}[$number][$platform_id][$encoding_id]{$language_id}
		$nameId = $nameRecord->getNameId();
		$platformId = $nameRecord->getPlatformId();
		$encodingId = $nameRecord->getPlatformEncodingId();
		$languageId = $nameRecord->getLanguageId();

		$strings = $this->strings;
		$strings = self::buildArray($strings, $nameId);
		$strings = self::buildArray($strings, $platformId);
		$strings = self::buildArray($strings, $encodingId);

		$this->strings[$nameId][$platformId][$encodingId][$languageId] = $nameRecord;
	}

	/**
	 * Get the name records
	 * 
	 * @return array
	 */
	public function getNameRecords() {
		return $this->nameRecords;
	}

	/**
	 * Get the strings
	 * 
	 * @return array
	 */
	public function getStrings() {
		return $this->strings;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the name record at the specified index
	 * 
	 * @return a name record
	 */
	public function getNameRecord2($index) {
		if(isset($this->nameRecords[$index])) {
			return $this->nameRecords[$index];
		} else {
			return null;
		}
	}

	public function findNameRecord($nameId, array $searches) {
		$nameRecord = null;

		foreach($searches as $search) {
			$nameRecord = $this->getNameRecord($nameId, $search->platformId, $search->encodingId, $search->languageId);

			if($nameRecord != null) {
				break;
			}
		}

		return $nameRecord;
	}

	public function getNameRecord($nameId, $platformId, $encodingId, $languageId) {
		$nameRecord = null;

		$nameRecords = $this->strings;
		if(isset($nameRecords[$nameId])) {
			$nameRecords = $nameRecords[$nameId];

			if(isset($nameRecords[$platformId])) {
				$nameRecords = $nameRecords[$platformId];

				if(isset($nameRecords[$encodingId])) {
					$nameRecords = $nameRecords[$encodingId];
	
					if(isset($nameRecords[$languageId])) {
						$nameRecord = $nameRecords[$languageId];
					}
				}
			}
		}

		return $nameRecord;
	}

	public function getNameRecordId($nameId) {
		$result = null;

		foreach($this->nameRecords as $nameRecord) {
			if($nameRecord->getNameId() == $nameId && $nameRecord->isReadable()) {
				
				if(isset($result)) {
					$str1 = $result->convertString();
					$str2 = $nameRecord->convertString();

					if(strcmp($str1, $str2) < 1) {
						$result = $nameRecord;
					}
				} else {
					$result = $nameRecord;
				}
			}
		}

		return $result;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this table directory
	 * 
	 * @return a string that contains information of this table directory
	 */
	public function __toString() {
		$string = '';

		$string .= 'Naming table' . "\r\n";
		$string .= '------------' . "\r\n";
		$string .= '  Format selector =             ' . $this->formatSelector . "\r\n";
		$string .= '  Number name records =         ' . $this->numberNameRecords . "\r\n";
		$string .= '  Offset start string storage = ' . $this->offsetStartStringStorage . "\r\n";
		$string .= '' . "\r\n";

		$i = 1;
		foreach ($this->nameRecords as $nameRecord) {
			$string .= $i++ . '. ' . "\r\n";
			$string .= $nameRecord->__toString() . "\r\n";
		}

		return $string;
	}
}
