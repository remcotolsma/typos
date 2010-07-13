<?php

namespace Pronamic\Typos\Views;

use Pronamic\Views\View;

/**
 * Title: Font view
 * Description: 
 * Copyright: Copyright (c) 2005 - 2010
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class FontView extends View {
	/**
	 * The font to create an view for
	 * 
	 * @var Font
	 */
	private $font;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and initializes an fonts view
	 */
	public function __construct() {

	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the font to create an view for
	 * 
	 * @return Font
	 */
	public function getFont() {
		return $this->font;
	}

	/**
	 * Set the font to display within this view
	 * 
	 * @param $font
	 */
	public function setFont($font) {
		$this->font = $font;
	}
}
