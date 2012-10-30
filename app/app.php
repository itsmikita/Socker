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
 * Application class
 */
class Application extends \Socker\Application {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		// add rewrite rules
		$this->addRules();
	}
	
	/**
	 * Add rewrite rules
	 */
	public function addRules() {
		$this->rewrite->addRule( '\/([^\/]+)\/?', 'controller=$1&method=index' );
		$this->rewrite->addRule( '\/([^\/]+)\/([^\/]+)\/?', 'controller=$1&method=$2' );
	}
}
