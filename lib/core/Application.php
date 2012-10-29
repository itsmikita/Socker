<?php

namespace Sugar;

/**
 * Version
 */
define( 'SUGAR_VERSION', '0.1' );

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
	public function run() {
		global $defaults;
		
		$this->query = new Query( $this->rewrite->parse() );
		
		$controller = $this->loadController( $this->query->getVar( 'controller', $defaults['controller'] ) );
		$method = $this->query->getVar( 'method', $defaults['method'] );
		$args = $this->query->getVar( 'args', array() );
		
		if( ! method_exists( $controller, $method ) )
			die( sprintf( 'Method %s doesn\'t exists in %s', $method, get_class( $controller ) ) );
		
		call_user_func_array( array( $controller, $method ), $args );
	}
	
	/**
	 * Boot
	 */
	private function boot() {
		$this->rewrite = new Rewrite();
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
	
	/**
	 * Load controller
	 */
	private function loadController( $controller ) {
		if( !file_exists( ABSPATH . "/controllers/{$controller}.php" ) )
			return false;
		
		require_once( ABSPATH . "/controllers/{$controller}.php" );
		
		// as $controller could be 'admin/Dashboard'
		$controller = explode( '/', $controller );
		$controller = '\\Controller\\' . end( $controller );
		
		if( !class_exists( $controller ) )
			return false;
		
		return new $controller();
	} 
}