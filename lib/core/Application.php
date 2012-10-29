<?php

namespace Sugar;

/**
 * Default Application class
 */
class Application {
	/**
	 * Constructor
	 */
	public function __construct() {
		// dev mode?
		$this->devMode();
		
		// boot
		$this->boot();
	}
	
	/**
	 * Run
	 */
	public function run() {
		global $defaults;
		
		$this->query->parse( $this->rewrite->parse() );
		
		$controller = $this->loadController( $this->query->getVar( 'controller', $defaults['controller'] ) );
		$method = $this->query->getVar( 'method' )
		$args = $this->query->getVar( 'args', array() );
		
		call_user_func_array( array( $controller, $method ), $args );
	}
	
	/**
	 * Boot
	 */
	private function boot() {
		$this->rewrite = new Rewrite();
		$this->query = new Query();
	}
	
	/**
	 * Development mode
	 */
	private function devMode() {
		if( defined( 'DEBUG' ) && 1 == DEBUG )
			error_reporting( E_ALL & ~ E_NOTICE );
		else
			error_reporting( 0 );
	}
}