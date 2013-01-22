<?php

/**
 * Default controller class
 *
 * @package Socker
 * @version 0.3
 * @author Mikita Stankevich <designovermatter@gmail.com>
 */

namespace Socker;

class Controller {
	private $current_screen;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		// define view class here, to be able to set dependencies (TODO)
		$this->view = new \Socker\View();
	}
	
	/**
	 * Index
	 */
	public function index() {}
}