<?php

namespace Pronamic\Typos;

/**
 * Title: Font table directory
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class TableDirectory {
	/**
	 * Indicator for SFNT version '1.0'
	 * 
	 * @doc http://www.microsoft.com/typography/otspec/otff.htm
	 * 
	 * @var hexadecimal
	 */
	const SFNT_VERSION_1_0 = 0x00010000;

	/**
	 * Indicator for SFNT version 'OTTO'
	 * 
	 * @doc http://www.microsoft.com/typography/otspec/otff.htm
	 * 
	 * @var hexadecimal
	 */
	const SFNT_VERSION_OTTO = 0x4F54544F;

	/**
	 * Indicator for SFNT version 'true'
	 * The Apple specification for TrueType fonts allows this value for sfnt version
	 * 
	 * @doc http://www.microsoft.com/typography/otspec/otff.htm
	 * @doc http://developer.apple.com/fonts/ttrefman/RM06/Chap6.html#ScalerTypeNote
	 * 
	 * @var hexadecimal
	 */
	const SFNT_VERSION_TRUE = 0x74727565;

	/**
	 * Indicator for SFNT version 'typ1' 
	 * The Apple specification for TrueType fonts allows this value for sfnt version
	 * 
	 * @doc http://www.microsoft.com/typography/otspec/otff.htm
	 * @doc http://developer.apple.com/fonts/ttrefman/RM06/Chap6.html#ScalerTypeNote
	 * 
	 * @var hexadecimal
	 */
	const SFNT_VERSION_TYPE1 = 0x74797031;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * A reference to the TrueType font file
	 */
	private $font;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Sfnt Version
	 */
	private $sfntVersion;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The number of tables
	 */
	private $numberTables;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Search range
	 */
	private $searchRange;

	/**
	 * Entry selector
	 */
	private $entrySelector;

	/**
	 * Range shift
	 */
	private $rangeShift;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The entries
	 */
	private $entries;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initialize a font table directory
	 * 
	 * @param ttf_TrueTypeFontFileObject $ttfFile
	 */
	public function __construct() {
		$this->entries = array();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Add the specified entry to this table directory
	 * 
	 * @param TableDirectoryEntry $entry
	 */
	public function addEntry(TableDirectoryEntry $entry) {
		$this->entries[] = $entry;
	}

	/**
	 * Get an array filled wat all entries
	 * 
	 * @return an array
	 */
	public function getEntries() {
		return $this->entries;
	}

	/**
	 * Get the entry at the specified index
	 * 
	 * @param index
	 */
	public function getEntry($index) {
		return $this->entries[$index];
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get a entry by tag name
	 * 
	 * @param tag a tag
	 */
	public function getEntryByTag($tag) {
		foreach ($this->entries as $entry) {
			if ($entry->getTag() == $tag) {
				return $entry;
			}
		}

		return null;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the version of this table directory
	 * 
	 * @return string
	 */
	public function getSfntVersion() {
		return $this->sfntVersion;
	}

	/**
	 * Set the SFNT version
	 * 
	 * @param string $version
	 */
	public function setSfntVersion($version) {
		$this->sfntVersion = $version;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the number of tables in this directory
	 * 
	 * @return an integer
	 */
	public function getNumberTables() {
		return $this->numberTables;
	}

	/**
	 * Set the number of tables in this directory
	 * 
	 * @param int $number
	 */
	public function setNumberTables($number) {
		$this->numberTables = $number;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the search range
	 * 
	 * @return an integer
	 */
	public function getSearchRange() {
		return $this->searchRange;
	}

	/**
	 * Set the search range
	 * 
	 * @param int $range
	 */
	public function setSearchRange($range) {
		$this->searchRange = $range;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the entry selector
	 * 
	 * @return an integer
	 */
	public function getEntrySelector() {
		return $this->entrySelector;
	}

	/**
	 * Set the entry selector
	 * 
	 * @param int $selector
	 */
	public function setEntrySelector($selector) {
		$this->entrySelector = $selector;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the range shift
	 * 
	 * @return an integer
	 */
	public function getRangeShift() {
		return $this->rangeShift;
	}

	/**
	 * Set the range shift
	 * 
	 * @param int $rangeShift
	 */
	public function setRangeShift($rangeShift) {
		$this->rangeShift = $rangeShift;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this table directory
	 * 
	 * @return a string that contains information of this table directory
	 */
	public function __toString() {
		$string = '';
		$string .= 'Table directory' . "\r\n";
		$string .= '---------------' . "\r\n";
		$string .= '  Sfnt version =   0x' . sprintf('%08X', $this->sfntVersion) . "\r\n";
		$string .= '  Number tables =  ' . $this->numberTables . "\r\n";
		$string .= '  Search range =   ' . $this->searchRange . "\r\n";
		$string .= '  Entry selector = ' . $this->entrySelector . "\r\n";
		$string .= '  Range shift =    ' . $this->rangeShift . "\r\n";
		$string .= '' . "\r\n";

		$i = 1;
		foreach ($this->entries as $entry) {
			$string .= $i++ . '. ' . $entry->__toString() . "\r\n";
		}

		return $string;
	}
}
