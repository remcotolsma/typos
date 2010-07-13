<?php

namespace Pronamic\Typos;

/**
 * Title: Font manager class
 * Description:
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class Manager {
	/**
	 * Create an save path for a file system from the specified string
	 *  
	 * @param string $string
	 * @return string
	 */
	public static function savePath($string) {
		$string = iconv("UTF-8", "ASCII//TRANSLIT", $string);

		$search = array('\\', '/', ':', '*', '?', '"', '<', '>', '|');
		$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ');
		$string = str_replace($search, $replace, $string);

		$string = trim($string, '. ');

		return $string;
	}

	/**
	 * Get the path for the specified font and file
	 * 
	 * @param Typos $font
	 * @param string $file the path to the font file
	 * @return string an path
	 */
	public static function getPath(Typos $font, $file = null) {
		$query = array();
		$query[] = new NameRecordQuery(NameTable::PLATFORM_MICROSOFT, Microsoft\Encodings::UNICODE_BMP, Microsoft\Languages::ENGLISH_UNITED_STATES);
		$query[] = new NameRecordQuery(NameTable::PLATFORM_MACINTOSH, Macintosh\Encodings::ROMAN, Macintosh\Languages::ENGLISH);

		$familyName = self::savePath($font->getFontFamilyName($query));
		$subFamilyName = self::savePath($font->getFontSubFamilyName($query));
		$fullFontName = self::savePath($font->getFullFontName($query));

		// Build path
		$path = '';

		// First level
		$first = substr($familyName, 0, 1);
		if(ctype_digit($first)) {
			$path .= '0-9';
		} else if(ctype_alpha($first)) {
			$path .= strtoupper($first);
		} else {
			$path .= '_';
		}

		$path .= DS;

		// Second level
		$second = substr($familyName, 0, 2);
		$second = ucfirst(strtolower($second));
		$second = str_replace(' ', '_', $second);
	
		$path .= $second;
		$path .= DS;

		// Third level
		$path .= $familyName;
		$path .= DS;

		// Fourth level
		if(!empty($subFamilyName)) {
			$path .= $subFamilyName;
			$path .= DS;
		}

		// File name
		$path .= $fullFontName;

		// File size
		if($file != null) {
			$path .= sprintf(' [%0.2f KiB]', filesize($file) / 1024);
		}

		// File extension
		if($font->isTrueType()) {
			$path .= '.otf';
		} else {
			$path .= '.ttf';
		}

		return $path;
	}
}