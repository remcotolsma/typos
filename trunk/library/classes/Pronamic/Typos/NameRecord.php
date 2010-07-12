<?php

namespace Pronamic\Typos;

/**
 * Title: Font name record
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class NameRecord {
	/**
	 * Platform ID
	 * 
	 * @var int
	 */
	private $platformId;

	/**
	 * Platform-specific encoding ID
	 * 
	 * @var int
	 */
	private $platformEncodingId;

	/**
	 * Language ID
	 * 
	 * @var int
	 */
	private $languageId;

	/**
	 * Name ID
	 * 
	 * @var int
	 */
	private $nameId;

	/**
	 * String length (in bytes)
	 * 
	 * @var int
	 */
	private $stringLength;

	/**
	 * String offset from start of storage area (in bytes)
	 * 
	 * @var int
	 */
	private $stringOffset;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The string
	 * 
	 * @var string
	 */
	private $string;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes a font name record
	 */
	public function __construct() {

	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the platform ID
	 * 
	 * @return int
	 */
	public function getPlatformId() {
		return $this->platformId;
	}

	/**
	 * Set the platform ID
	 * 
	 * @param int $id
	 */
	public function setPlatformId($id) {
		$this->platformId = $id;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the platform encoding ID
	 * 
	 * @return int
	 */
	public function getPlatformEncodingId() {
		return $this->platformEncodingId;
	}

	/**
	 * Set the platform encoding ID
	 * 
	 * @param int $id
	 */
	public function setPlatformEncodingId($id) {
		$this->platformEncodingId = $id;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the language ID
	 * 
	 * @return int
	 */
	public function getLanguageId() {
		return $this->languageId;
	}

	/**
	 * Set the language ID
	 * 
	 * @param int $id
	 */
	public function setLanguageId($id) {
		$this->languageId = $id;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the name ID
	 * 
	 * @return int
	 */
	public function getNameId() {
		return $this->nameId;
	}

	/**
	 * Set the name ID
	 * 
	 * @param int $id
	 */
	public function setNameId($id) {
		$this->nameId = $id;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the length of the string within this name record
	 * 
	 * @return int
	 */
	public function getStringLength() {
		return $this->stringLength;
	}

	/**
	 * Set the string length
	 * 
	 * @param int $string
	 */
	public function setStringLength($length) {
		$this->stringLength = $length;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the string offset position with the font file
	 * 
	 * @return int
	 */
	public function getStringOffset() {
		return $this->stringOffset;
	}

	/**
	 * Set the string offset position with the font file
	 * 
	 * @param int $offset
	 */
	public function setStringOffset($offset) {
		$this->stringOffset = $offset;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the string
	 * 
	 * @return a string
	 */
	public function getString() {
		return $this->string;
	}

	/**
	 * Set the string
	 * 
	 * @param string $string
	 */
	public function setString($string) {
		$this->string = $string;
	}

	/**
	 * Check if this name record is readable
	 * 
	 * @return boolean
	 */
	public function isReadable() {
		$encoding = Encoding::determineEncoding($this->platformId, $this->platformEncodingId);

		return Encoding::canConvert($this->string, $encoding);
	}

	/**
	 * Convert the string within this name record to the specified 
	 * output encoding 
	 * 
	 * @param string $output
	 * @return string or null on failure
	 */
	public function convertString($output = 'UTF-8') {
		$encoding = Encoding::determineEncoding($this->platformId, $this->platformEncodingId);

		return Encoding::convert($this->string, $encoding, $output);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this name record
	 * 
	 * @return a string that contains information of this name record
	 */
	public function __toString() {
		$string = '';

		$string .= '  Platform ID =           ' . $this->platformId . "\r\n";
		$string .= '  Platform encoding ID =  ' . $this->platformEncodingId . "\r\n";
		$string .= '  Language ID =           ' . $this->languageId . "\r\n";
		$string .= '  Name ID =               ' . $this->nameId . "\r\n";
		$string .= '  String length =         ' . $this->stringLength . "\r\n";
		$string .= '  String offset =         ' . $this->stringOffset . "\r\n";
		$string .= '  String =                ' . $this->getString() . "\r\n";
		$string .= '  Coverted string =       ' . $this->convertString() . "\r\n";

		return $string;
	}
}
