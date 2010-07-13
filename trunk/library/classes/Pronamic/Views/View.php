<?php

namespace Pronamic\Views;

/**
 * Title: View
 * Description:
 * Copyright: Copyright (c) 2005 - 2008
 * Company: Pronamic Internet, Vormgeving en Software
 * @author Remco Tolsma
 * @version 1.0
 */
class View {
	/**
	 * The views within this view
	 * 
	 * @var ArrayObject
	 */
	protected $views;

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Constructs and in itializes a view
	 */
	public function __construct($include = null) {
		$this->views = array();

		$this->setInclude($include);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Add the specified view to this view
	 * 
	 * @param orbis_views_View $view the view to add
	 * @param mixed $key 
	 */
	public function add(self $view, $offset = null) {
		$this->views->add($view, $offset);
	
		return $view;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the view at the specified offset
	 * 
	 * @param mixed $offset
	 * @return an view or null
	 */
	public function getView($offset) {
		return $this->views->get($offset);
	}

	/**
	 * Check if there is an view at the specified offset
	 * 
	 * @param mixed $offset
	 * @return boolean true if view exists, false otherwise
	 */
	public function hasView($offset) {
		return $this->views->offsetExists($offset);
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Remove the component at the specified key
	 * 
	 * @param mixed $key
	 */
	public function remove($key) {
		$this->views->remove($key);

		return $this;
	}

	/**
	 * Remove all the components
	 * 
	 * @return $this
	 */
	public function removeAll() {
		$this->views->removeAll();

		return $this;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Render the specified child
	 *
	 * @param unknown_type $object
	 */
	public function renderView($object, $print = true) {
		$result = null;

		if(isset($this->views[$object])) {
			$result = $this->views[$object]->render($print);
		}

		return $result;
	}

	/**
	 * Render the child views
	 */
	public function renderViews($print = true) {
		$result = '';

		foreach($this->views as $view) {
			$result .= $view->render($print);
		}

		return $result;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Get the include file
	 * 
	 * @return string an include file
	 */
	public function getInclude() {
		return $this->include;
	}

	/**
	 * Set the include file
	 * 
	 * @param string $include an file
	 */
	public function setInclude($include = null) {
		$this->include = $include;
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Render this container component
	 * 
	 * @param boolean $print
	 * @return string
	 */
	public function render($print = true) {
		if(!$print) {
			ob_start();
		}

		if($this->include != null && is_file($this->include)) {
			include $this->include;
		} else {
			$this->__echo();
		}

		if(!$print) {
			return ob_get_clean();
		}
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Echo this view
	 */
	public function __echo() {
		echo $this->renderComponents();
	}

	///////////////////////////////////////////////////////////////////////////

	/**
	 * Check if the specified object is an instance of the specified class and 
	 * return the object if true
	 * 
	 * @param mixed $object
	 * @param mixed $class
	 * @return the object or null
	 */
	public static function getAs($object, $class) {
		if($object instanceof $class) {
			return $object;
		} else {
			return null;
		}
	}
}
