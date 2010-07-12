<?php

namespace Pronamic\Typos;

/**
 * Title: Typos
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Typos {
	/**
	 * Constructs and initializes an Typos font object
	 * 
	 * @param Font $font the font to read
	 */
	public function __construct(Font $font) {
		$this->font = $font;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Check if the font is the specified version or versions
	 * 
	 * @param mixed $version a integer or array with integers
	 * @return boolean
	 */
	public function isSfntVersion($version) {
		$v = $this->font->getTableDirectory()->getSfntVersion();

		if(is_array($version)) {
			return in_array($v, $version);
		} else {
			return $v == $version;
		}
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Check if the font is an TrueType font
	 * 
	 * @return boolean true if the font is an TrueType font, false otherwise
	 */
	public function isTrueType() {
		$versions = array(TableDirectory::SFNT_VERSION_1_0, TableDirectory::SFNT_VERSION_TRUE);

		return $this->isSfntVersion($versions);
	}

	/**
	 * Check if the font is an OpenType font
	 * 
	 * @return boolean true if the font is an OpenType font, false otherwise
	 */
	public function isOpenType() {
		$version = TableDirectory::SFNT_VERSION_OTTO;

		return $this->isSfntVersion($version);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the name record by the specified name id
	 * 
	 * @param int $nameId
	 */
	public function getNameRecord($nameId, $search) {
		$nameTable = $this->font->nameTable;

		if($nameTable != null) {
			$nameRecord = $nameTable->findNameRecord($nameId, $search);

			if($nameRecord != null) {
				return $nameRecord->convertString();
			}
		}

		return '';
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the copyright notice
	 *
	 * @return string
	 */
	public function getCopyrightNotice($search) {
		return $this->getNameRecord(NameTable::NAME_ID_COPYRIGHT, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the font family name
	 *
	 * @return string
	 */
	public function getFontFamilyName($search) {
		return $this->getNameRecord(NameTable::NAME_ID_FONT_FAMILY_NAME, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the font sub family name
	 *
	 * @return string
	 */
	public function getFontSubFamilyName($search) {
		return $this->getNameRecord(NameTable::NAME_ID_FONT_SUB_FAMILY_NAME, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the unique font identifier
	 *
	 * @return string
	 */
	public function getUniqueFontIdentifier($search) {
		return $this->getNameRecord(NameTable::NAME_ID_UNIQUE_FONT_IDENTIFIER, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the full font name
	 *
	 * @return string
	 */
	public function getFullFontName($search) {
		return $this->getNameRecord(NameTable::NAME_ID_FULL_FONT_NAME, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the version
	 * Version string. In n.nn format.
	 *
	 * @return string
	 */
	public function getVersion($search) {
		return $this->getNameRecord(NameTable::NAME_ID_VERSION, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the post script name
	 *
	 * @return string
	 */
	public function getPostScriptName($search) {
		return $this->getNameRecord(NameTable::NAME_ID_POSTSCRIPT_NAME, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the trade mark; this is used to save any trademark notice/information 
	 * for this font. Such information should be based on legal advice. This is 
	 * distinctly separate from the copyright.
	 *
	 * @return string
	 */
	public function getTradeMark($search) {
		return $this->getNameRecord(NameTable::NAME_ID_TRADEMARK, $search);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create a string representation
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->font->__toString();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Load a font from string
	 * @doc Creating streams from strings in PHP: http://www.rooftopsolutions.nl/blog/222
	 * 
	 * @param string $string
	 * @return self
	 */
	public static function loadFromString($string) {
		// return self::loadFromFile('data://text/plain,' . $string);
		return self::loadFromFile('data://text/plain;base64,'  . base64_encode($string));
	}

	/**
	 * Load a font form file
	 * 
	 * @param string $file the path to an file
	 * @return self
	 */
	public static function loadFromFile($file) {
		// On systems which differentiate between binary and text files (i.e. Windows) 
		/// the file must be opened with 'b' included in fopen()  mode parameter. 
		$resource = fopen($file, 'rb');

		return self::loadFromResource($resource);
	}

	/**
	 * Load a font from the specified resource
	 * 
	 * @param resource $resource
	 * @return self
	 */
	public static function loadFromResource($resource) {
		$stream = new Stream($resource);

		$fontReader = new FontReader();

		$font = $fontReader->read($stream);

		return new self($font);
	}
}
