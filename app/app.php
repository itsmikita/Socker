<?php

/**
 * Call it anything
 */
namespace App;

/**
 * Load configuration
 */
require_once( 'config.php' );

/**
 * Load core classes
 */
require_once( ABSPATH . '/lib/core/Application.php' );
require_once( ABSPATH . '/lib/core/Rewrite.php' );
require_once( ABSPATH . '/lib/core/Query.php' );
require_once( ABSPATH . '/lib/core/Controller.php' );
require_once( ABSPATH . '/lib/core/Model.php' );
require_once( ABSPATH . '/lib/core/View.php' );

/**
 * You could extend all basic classes here below to fit your application.
 * Load libraries, eat bananas, do whatever you want here.
 */

/**
 * Your final application class
 */
final class Application extends \Socker\Application {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		$this->addRules();
	}
	
	/**
	 * Add rewrite rules
	 *
	 * Rewrite rules are used to define nice URL and route them to right 
	 * controllers and its methods.
	 */
	private function addRules() {
		$this->rewrite->addRule( '\/([^\/]+)\/?', 'controller=$1&method=index' );
		$this->rewrite->addRule( '\/([^\/]+)\/([^\/]+)\/?', 'controller=$1&method=$2' );
	}
}
