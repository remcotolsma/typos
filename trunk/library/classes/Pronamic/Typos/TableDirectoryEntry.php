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
class TableDirectoryEntry {
	/**
	 * Tag 4 -byte identifier
	 * 
	 * @var string
	 */
	private $tag;

	/**
	 * Checksum
	 * 
	 * @var int
	 */
	private $checkSum;

	/**
	 * Offset
	 * 
	 * @var int
	 */
	private $offset;

	/**
	 * Length
	 * 
	 * @var int
	 */
	private $length;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initialize font table directory entry
	 */
	public function __construct() {
		
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the tag
	 * 
	 * @return int the tag
	 */
	public function getTag() {
		return $this->tag;
	}

	/**
	 * Set the tag
	 * 
	 * @param int $tag
	 */
	public function setTag($tag) {
		$this->tag = $tag;
	}

	/**
	 * Get the tag as a string
	 * 
	 * @return a string representation of the tag
	 */
	public function getTagAsString() {
		return Util::uLongToString($this->tag);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the checksum
	 * 
	 * @return the checksum
	 */
	public function getCheckSum() {
		return $this->checkSum;
	}

	/**
	 * Set the checksum
	 * 
	 * @param int $checkSum
	 */
	public function setCheckSum($checkSum) {
		$this->checkSum = $checkSum;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the offset of this directory entry
	 * 
	 * @return the offset
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * Set the offset of this directory entry
	 * 
	 * @param int $offset the offset
	 */
	public function setOffset($offset) {
		$this->offset = $offset;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the length of this directory entry
	 * 
	 * @return the length
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * Set the length of this directory entry
	 * 
	 * @param int $length
	 */
	public function setLength($length) {
		$this->length = $length;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this directory entry
	 * 
	 * @return a string
	 */
	public function __toString() {
		$string = '';

		$string .= $this->getTagAsString();
		$string .= ' - ';
		$string .= 'chksm = 0x' . sprintf('%08X', $this->checkSum);
		$string .= ', off = 0x' . sprintf('%08X', $this->offset);
		$string .= ', len = ' . $this->length;

		return $string;
	}
}
