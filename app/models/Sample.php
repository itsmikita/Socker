<?php

/**
 * Sample model class
 *
 * @package Socker
 * @version 0.3
 * @author Mikita Stankevich <designovermatter@gmail.com>
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