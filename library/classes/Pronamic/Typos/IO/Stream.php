<?php

namespace Pronamic\Typos\IO;

/**
 * Title: Stream
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Stream {
	/**
	 * The number of seconds between the epoch in 1904 and 1970
	 * 365 * 86400 * (1970 - 1904) + 86400 * 17 = 2082844800
	 * 
	 * @doc http://programming.itags.org/unix-linux-programming/98776/
	 * 
	 * @var int
	 */
	const SEC_BETWEEEN_1904_AND_1970 = 2082844800;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * The resource 
	 * 
	 * @var resource
	 */
	private $resource;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes an stream
	 * 
	 * @param resource $resource
	 */
	public function __construct($resource) {
		$this->resource = $resource;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Rewind the position
	 * 
	 * @return returns TRUE on success or FALSE on failure
	 */
	public function rewind() {
		return rewind($this->resource);
	}

	/**
	 * Seek on the stream
	 * 
	 * @param int $offset
	 * @param int $whence 
	 * @return upon success, returns 0; otherwise, returns -1. Note that seeking past EOF is not considered an error. 
	 */
	public function seek($offset, $whence = SEEK_SET) {
		return fseek($this->resource, $offset, $whence);
	}

	/**
	 * Binary-safe file read
	 * 
	 * @param int $length
	 */
	public function read($length) {
		return fread($this->resource, $length);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Read and unpack the specified length and format
	 * 
	 * @param string $format
	 * @param int $length
	 */
	private function readUnpack($format, $length) {
		$data = $this->read($length);

		if(strlen($data) == $length) {
			return unpack($format, $data);
		} else {
			throw new \Exception('Not able read the specified length (' . $length . ') and unpack the data in the specified format (' . $format . ')');
		}
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Read an USHORT (16 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 * 
	 * @return 
	 */
	public function readUShort() {
		$data = $this->readUnpack('n', 2);

		return $data[1];
	}

	/**
	 * Read an ULONG (32 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 * 
	 * @return 
	 */
	public function readULong() {
		$data = $this->readUnpack('N', 4);

		return $data[1];
	}

	/**
	 * Read an ULONG (32 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 */
	public function readFixed() {
		return $this->readULong();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Read a long date time
	 * 
	 * @return \DateTime
	 */
	public function readLongDateTime() {
//		$secondsSince1904 = $this->readULong();

		$value = $this->read(8);

		printf('%b', $value);

		$secondsSince1970 = $secondsSince1904 - self::SEC_BETWEEEN_1904_AND_1970;

		return new \DateTime('@' . $secondsSince1970);
	}
}
