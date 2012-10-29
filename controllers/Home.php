<?php

namespace App;
/**
 *
 */

class Home extends /Sugar/Controller {
	/**
	 * Constructor
	 */
	public function __construct() {
		//...
	}
	
	/**
	 * Index
	 */
	public function index() {
		$args = array(
			'var1' => 'test',
			'var2' => 'test2'
		);
		
		$view = new View( 'home/page' );
		$view->render( $args );
	}
	
	/**
	 * Page
	 *
	 * @param string slug - Page slug
	 */
	public function page( $slug = '' ) {
		$view = new View( 'home/page' );
		$view->render( compact( 'slug' ) );
	}
}