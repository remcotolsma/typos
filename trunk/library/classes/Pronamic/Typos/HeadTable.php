<?php

namespace Pronamic\Typos;

/**
 * Title: Head table
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class HeadTable extends Table {
	/**
	 * Magic number
	 * 
	 * @var int
	 */
	const MAGIC_NUMBER = 0x5F0F3CF5;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Version
	 * 
	 * @var int
	 */
	private $version;

	/**
	 * Font revision
	 * 
	 * @var int
	 */
	private $fontRevision;

	/**
	 * Check sum adjustment
	 * 
	 * @var int
	 */
	private $checkSumAdjustment;

	/**
	 * Magic number
	 * 
	 * @var int
	 */
	private $magicNumber;

	/**
	 * Flags
	 * 
	 * @var int
	 */
	private $flags;

	/**
	 * Units per em
	 * 
	 * @var int
	 */
	private $unitsPerEm;

	/**
	 * Created
	 * 
	 * @var DateTime
	 */
	private $created;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initialize an head table
	 */
	public function __construct() {
		
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the version
	 * 
	 * @return int
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Set the version
	 * 
	 * @param int $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the font revision
	 * 
	 * @return an intenger
	 */
	public function getFontRevision() {
		return $this->fontRevision;
	}

	/**
	 * Set the font revision
	 * 
	 * @param int $number
	 */
	public function setFontRevision($revision) {
		$this->fontRevision = $revision;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the check sum adjustment
	 * 
	 * @return an intenger
	 */
	public function getCheckSumAdjustment() {
		return $this->checkSumAdjustment;
	}

	/**
	 * Set the check sum adjustment
	 * 
	 * @param int $checkSumAdjustment
	 */
	public function setCheckSumAdjustment($checkSumAdjustment) {
		$this->checkSumAdjustment = $checkSumAdjustment;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the magic number
	 * 
	 * @return an intenger
	 */
	public function getMagicNumber() {
		return $this->magicNumber;
	}

	/**
	 * Set the magic number
	 * 
	 * @param int $magicNumber
	 */
	public function setMagicNumber($magicNumber) {
		$this->magicNumber = $magicNumber;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the flags
	 * 
	 * @return an intenger
	 */
	public function getFlags() {
		return $this->flags;
	}

	/**
	 * Set the flags
	 * 
	 * @param int $flags
	 */
	public function setFlags($flags) {
		$this->flags = $flags;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the units per em
	 * 
	 * @return an intenger
	 */
	public function getUnitsPerEm() {
		return $this->unitsPerEm;
	}

	/**
	 * Set the units per em
	 * 
	 * @param int $units
	 */
	public function setUnitsPerEm($units) {
		$this->unitsPerEm = $units;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the created date
	 * 
	 * @return DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Set the created date
	 * 
	 * @param DateTime $date
	 */
	public function setCreated($date) {
		$this->created = $date;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this head table
	 * 
	 * @return a string that contains information of this table directory
	 */
	public function __toString() {
		$string = '';

		$string .= 'Head table' . "\r\n";
		$string .= '------------' . "\r\n";
		$string .= '  Version =                     ' . sprintf('0x%08X', $this->version) . "\r\n";
		$string .= '  Font revision =               ' . $this->fontRevision . "\r\n";
		$string .= '  Check sum adjustment =        ' . $this->checkSumAdjustment . "\r\n";
		$string .= '  Magic number =                ' . sprintf('0x%08X', $this->magicNumber) . "\r\n";
		$string .= '  Flags =                       ' . $this->flags . "\r\n";
		$string .= '  Units per em =                ' . $this->unitsPerEm . "\r\n";
		$string .= '  Created =                     ' . ( $this->created != null ? $this->created->format(DATE_RSS) : '' ) . "\r\n";

		return $string;
	}
}
