<?php

/**
 * Admin login controller
 *
 * @package Mochilla
 * @version 0.1
 * @author Mikita Stankevich <designovermatter@gmail.com>
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