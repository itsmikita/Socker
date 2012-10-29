<?php

/**
 * Call this anything
 */
namespace App;

/**
 * Load configuration
 */
require_once( 'config.php' );

/**
 * Load core classes
 */
require_once( 'lib/core/Application.php' );
require_once( 'lib/core/Rewrite.php' );
require_once( 'lib/core/Query.php' );
require_once( 'lib/core/Controller.php' );
require_once( 'lib/core/Model.php' );
require_once( 'lib/core/View.php' );

/**
 * Application class
 */
class Application extends \Sugar\Application {
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
