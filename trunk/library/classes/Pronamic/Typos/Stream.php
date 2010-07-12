<?php

namespace Pronamic\Typos;

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
	 * Read an USHORT (16 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 * 
	 * @return 
	 */
	public function readUShort() {
		$data = unpack('n', $this->read(2));

		return $data[1];
	}

	/**
	 * Read an ULONG (32 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 * 
	 * @return 
	 */
	public function readULong() {
		$data = unpack('N', $this->read(4));

		return $data[1];
	}

	/**
	 * Read an ULONG (32 bit) from the file
	 * All TrueType fonts use Motorola-style byte ordering (Big Endian)
	 */
	public function readFixed() {
		return $this->readULong();
	}
}