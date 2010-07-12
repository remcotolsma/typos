<?php

namespace Pronamic\Typos;

class Encoding {
	/**
	 * Encodings table
	 * 
	 * @var array
	 */
	public static $encodings = array(
		NameTable::PLATFORM_APPLE_UNICODE => array(
			0 => 'UTF-16' , // Unicode 1.0 semantics
			1 => 'UTF-16' , // Unicode 1.1 semantics
			2 => 'UTF-16' , // ISO 10646 semantics
			3 => 'UCS-2' , // Unicode 2.0 and onwards semantics, Unicode BMP only.
			4 => 'UTF-16' , // Unicode 2.0 and onwards semantics, Unicode full repertoire.
			5 => 'UTF-16'   // Unicode Variation Sequences
		) , 
		NameTable::PLATFORM_MACINTOSH => array(
			 0 => 'MacRoman' , // Roman
			 1 => null , // Japanese
			 2 => null , // Chinese (Traditional)
			 3 => null , // Korean
			 4 => 'MacArabic' , // Arabic
			 5 => 'MacHebrew' , // Hebrew
			 6 => 'MacGreek' , // Greek
			 7 => null , // Russian
			 8 => 'MacSymbol' , // RSymbol
			 9 => null , // Devanagari
			10 => null , // Gurmukhi
			11 => null , // Gujarati
			12 => null , // Oriya
			13 => null , // Bengali
			14 => null , // Tamil
			15 => null , // Telugu
			16 => null , // Kannada
			17 => null , // Malayalam
			18 => null , // Sinhalese
			19 => null , // Burmese
			20 => null , // Khmer
			21 => null , // Thai
			22 => null , // Laotian
			23 => null , // Georgian
			24 => null , // Armenian
			25 => null , // Chinese (Simplified)
			26 => null , // Tibetan
			27 => null , // Mongolian
			28 => null , // Geez
			29 => null , // Slavic
			30 => null , // Vietnamese
			31 => null , // Sindhi
			32 => null   // Uninterpreted
		) , 
		NameTable::PLATFORM_ISO => array(
			0 => 'ASCII' , // 7-bit ASCII
			1 => 'ISO-10646' , // ISO 10646
			2 => 'ISO-8859-1' // ISO 8859-1
		) ,
		NameTable::PLATFORM_MICROSOFT => array(
			 0 => null , // Symbol
			 1 => 'UCS-2' , // Unicode BMP (UCS-2)
			 2 => 'Shift_JIS' , // ShiftJIS
			 3 => 'GB2312' , // PRC
			 4 => 'Big5' , // Big5
			 5 => null , // Wansung
			 6 => 'Johab' , // Johab
			 7 => null , // Reserved
			 8 => null , // Reserved
			 9 => null , // Reserved
			10 => 'UCS-4' // Unicode UCS-4
		) , 
		NameTable::PLATFORM_CUSTOM => array(
			
		)
	);

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Determine the encoding of the specified platform id and platform encoding id
	 * 
	 * @param int $platformId
	 * @param int $platformEncodingId
	 * @return string an indicator of an encoding
	 */
	public static function determineEncoding($platformId, $platformEncodingId) {
		$encoding = null;

		$encodings = self::$encodings;

		if(isset($encodings[$platformId])) {
			$encodings = $encodings[$platformId];

			if(isset($encodings[$platformEncodingId])) {
				$encoding = $encodings[$platformEncodingId];
			}
		}

		return $encoding;
	}

	/**
	 * Check if the system knows the specified encoding en the string is 
	 * encoded in that encoding
	 * 
	 * @param string $string
	 * @param string $encoding
	 */
	public static function canConvert($string, $encoding) {
		$canConvert = false;

		$knownEncodings = mb_list_encodings();

		if(in_array($encoding, $knownEncodings)) {
			$canConvert = mb_check_encoding($string, $encoding);
		}

		if($encoding == 'MacRoman') {
			$canConvert = true;
		}

		return $canConvert;
	}

	/**
	 * Convert the string within this name record to the specified 
	 * output encoding 
	 * 
	 * @param string $output
	 * @return string or null on failure
	 */
	public static function convert($string, $input, $output = 'UTF-8') {
		$convert = null;

		if(self::canConvert($string, $input)) {
			if($input == 'MacRoman') {
				$convert = iconv('macintosh', $output, $string);
			} else {
				$convert = mb_convert_encoding($string, $output, $input);
			}
		}

		return $convert;
	}
}