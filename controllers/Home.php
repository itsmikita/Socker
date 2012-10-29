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
	}
	
	/**
	 * Index
	 */
	public function index() {
		$args = array(
			'var1' => 'test',
			'var2' => 'test2'
		);
		
		$view = new \Sugar\View( 'home/index' );
		$view->render( $args );
	}
	
	/**
	 * Page
	 *
	 * @param string slug - Page slug
	 */
	public function page( $slug = '' ) {
		$view = new \Sugar\View( 'home/page' );
		$view->render( compact( 'slug' ) );
	}
}