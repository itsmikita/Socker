<?php

/**
 * Sample controller class.
 *
 * @package Socker
 * @version 0.3
 * @author Mikita Stankevich <designovermatter@gmail.com>
 */

namespace Controller;

/**
 *
 */

class Home extends \Socker\Controller {
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
		$args = array(
			'var1' => 'test',
			'var2' => 'test2'
		);
		
		$this->view->render( 'home/index', $args );
	}
	
	/**
	 * Page
	 *
	 * @param string slug - Page slug
	 */
	public function page( $slug = '' ) {
		global $app;
		
		// laod model
		$sample = $app->loadModel( 'sample' );
		$something = $sample->doSomething();
		
		$this->view->render( 'home/page', compact( 'slug', 'something' ) );
	}
}