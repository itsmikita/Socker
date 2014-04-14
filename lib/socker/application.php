<?php

/**
 * This is the only class needed to run this framework.
 * I tried to keep it as simple as I only could. And as
 * result this class has only one hook: init
 */

namespace Socker;

/**
 * Tiny application class
 */
class Application {
	// Routes
	private $routes = array();
	
	// Actions
	private $actions = array();
	
	/**
	 * Add callback to an action
	 *
	 * @param string $event
	 * @param callable $callback
	 * @param int $priority
	 */
	public function on( $event, $callback, $priority = null ) {
		if( ! isset( $this->actions[ $event ] ) )
			$this->actions[ $event ] = array();
		
		$priority = $priority || 1 + count( $this->actions[ $event ] );
		
		$this->actions[ $event ][ $priority ] = $callback;
	}
	
	/**
	 * Run action callbacks
	 *
	 * @param string $event
	 */
	public function doing( $event ) {
		$args = func_get_args();
		array_shift( $args );
		
		if( empty( $this->actions[ $event ] ) )
			return @$args[0];
		
		foreach( $this->actions[ $event ] as $callback )
			$these = call_user_func_array( $callback, $args );
		
		return $these ? $these : @$args[0];
	}
	
	/**
	 * Setup GET requests
	 *
	 * @param string $route
	 * @param callable $callback
	 * @param int priority
	 */
	public function get( $route, $callback, $priority = null ) {
		if( ! isset( $this->routes[ $route ] ) )
			$this->routes[ $route ] = array();
		
		$priority = $priority || 1 + count( $this->routes[ $route ] );
		
		$this->routes[ $route ][ $priority ] = $callback;
		
		ksort( $this->routes[ $route ] );
	}
	
	/**
	 * Route GET requests
	 */
	public function route() {
		$uri = explode( '?', $_SERVER['REQUEST_URI'] );
		$uri = str_replace( HOMEURL, '', 'http://' . $_SERVER['SERVER_NAME'] . $uri[0] );
		
		if( '' == $uri )
			$uri = '/';
		
		$_callbacks = array();
		
		foreach( $this->routes as $route => $callbacks ) {
			if( preg_match( '/^' . str_replace( '/', '\/', $route ) . '$/i', $uri ) )
				$_callbacks[] = $callbacks;
		}
		
		if( empty( $_callbacks ) )
			return $this->view( '404.php' );
		
		ksort( $_callbacks );
		
		foreach( $_callbacks as $_routes )
			foreach( $_routes as $callback )
				call_user_func_array( $callback, func_get_args() );
	}
	
	/**
	 * Redirect
	 *
	 * @param string $location
	 * @param int $status
	 */
	public function redirect( $location, $status = 301 ) {
		$location = preg_replace( '|[^a-z0-9-~+_.?#=&;,/:%!]|i', '', $location );
		
		if( ! $location )
			return false;
		
		header( "Location: $location", true, $status );
		exit();
	}
	
	/**
	 * Loads view
	 *
	 * @param string $filename
	 * @param array $args
	 * @param bool $include
	 */
	public function view( $filename, $args = array(), $include = true ) {
		$filepath = VIEWS . '/' . $filename;
		
		if( ! file_exists( $filepath ) )
			return $this->error( "View '$filename' is missing." );
		
		if( ! $include )
			return file_get_contents( $filepath );
		
		$args['app'] = $this;
		$args['home_url'] = HOMEURL;
		
		if( $args )
			extract( $args, EXTR_SKIP );
		
		include( $filepath );
	}
	
	/**
	 * Home URL
	 *
	 * @param string $path
	 */
	public function homeUrl( $path = '' ) {
		return HOMEURL . '/' . ltrim( $path, '/' );
	}
	
	/**
	 * Intern error handler
	 *
	 * @param string $message
	 * @param bool $json
	 */
	public function error( $message, $json = false ) {
		if( $json )
			return array( 'error' => true, 'message' => $message );
		
		// So far
		die( var_dump( $message ) );
	}
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$app = $this;
		
		// Initialize app
		foreach( glob( APP . '/*.php' ) as $filename )
			if( ! preg_match( '/init\.php$/i', $filename ) )
				include( $filename );
		
		// The trigger
		$this->doing( 'init' );
		
		// Route
		$this->route();
	}
}