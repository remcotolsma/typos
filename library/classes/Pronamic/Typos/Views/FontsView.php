<?php

namespace Pronamic\Typos\Views;

use Pronamic\Views\View;

/**
 * Title: Fonts view
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class FontsView extends View {
	/**
	 * The fonts to create an view for
	 * 
	 * @var array
	 */
	private $fonts;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes an fonts view
	 */
	public function __construct() {
		$this->fonts = array();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the fonts to create an view for
	 * 
	 * @return array
	 */
	public function getFonts() {
		return $this->fonts;
	}

	/**
	 * Set the fonts to display within this view
	 * 
	 * @param array $fonts
	 */
	public function setFonts(array $fonts) {
		$this->fonts = $fonts;
	}
}
