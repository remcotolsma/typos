<?php

namespace Pronamic\Typos;

/**
 * Title: Font
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Font {
	/**
	 * The table directory of this font
	 * 
	 * @var TableDirectory
	 */
	private $tableDirectory;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The tables within this font
	 * 
	 * @var array
	 */
	private $tables;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes an font
	 */
	public function __construct() {
		$this->tables = array();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the table directory of this font
	 * 
	 * @return TableDirectory
	 */
	public function getTableDirectory() {
		return $this->tableDirectory;
	}

	/**
	 * Set the table directory of this font
	 * 
	 * @param TableDirectory $tableDirectory
	 */
	public function setTableDirectory(TableDirectory $tableDirectory) {
		$this->tableDirectory = $tableDirectory;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation of this font file
	 * 
	 * @return string an string that contains information of this font file
	 */
	public function __toString() {
		if ($this->tableDirectory != null) {
			return $this->tableDirectory->__toString();
		} else {
			return 'Empty font';
		}
	}
}
