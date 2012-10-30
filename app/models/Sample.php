<?php

/**
 * This is sample model class
 */

namespace Model;

/**
 *
 */

class Sample extends \Socker\Model {
	private $secret;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->secret = 'Hello World!';
	}
	
	/**
	 * Do something
	 */
	public function doSomething() {
		return $this->secret;
	}
}