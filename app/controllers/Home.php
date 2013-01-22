<?php

/**
 * Sample controller class.
 *
 * @package Socker
 * @author Mikita Stankiewicz <designovermatter@gmail.com>
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
		
		$this->view->enqueueScript( 'jquery', 'http://code.jquery.com/jquery-1.9.0.js' );
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