<?php

namespace Controller;

/**
 *
 */

class Home extends \Sugar\Controller {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		// define view class here, to be able to set dependencies
		$this->view = new \Sugar\View();
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
		$this->view->render( 'home/page', compact( 'slug' ) );
	}
}