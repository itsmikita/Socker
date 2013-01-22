<?php

/**
 * Admin login controller
 *
 * @package Socker
 * @author Mikita Stankiewicz <designovermatter@gmail.com>
 */

namespace Controller;

/**
 *
 */

class Login extends \Socker\Controller {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		// define view class here, to be able to set dependencies (TODO)
		$this->view = new \Socker\View();
	}
	
	/**
	 * Index
	 */
	public function index() {
		
	}
}