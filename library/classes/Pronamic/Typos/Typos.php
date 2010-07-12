<?php

namespace Pronamic\Typos;

class Typos {
	public function __construct(Font $font) {
		$this->font = $font;
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
	 * Load a TrueType font from string
	 * @doc Creating streams from strings in PHP: http://www.rooftopsolutions.nl/blog/222
	 * 
	 * @param string $string
	 * @return 
	 */
	public static function loadFromString($string) {
		// return self::loadFromFile('data://text/plain,' . $string);
		return self::loadFromFile('data://text/plain;base64,'  . base64_encode($string));
	}

	public static function loadFromFile($file) {
		// On systems which differentiate between binary and text files (i.e. Windows) 
		/// the file must be opened with 'b' included in fopen()  mode parameter. 
		$resource = fopen($file, 'rb');

		return self::loadFromResource($resource);
	}

	public static function loadFromResource($resource) {
		$stream = new Stream($resource);

		$fontReader = new FontReader();

		$font = $fontReader->read($stream);

		return new self($font);
	}
}
