<?php

/**
 * This is base class for your application. Don't tempt to modify it
 * here, better extend and overwrite it in your app.php.
 */

namespace Socker;

/**
 * Version
 */
define( 'SOCKER_VERSION', '0.1' );

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
	 * Development mode
	 */
	private function devMode() {
		if( defined( 'DEBUG' ) && 1 == DEBUG )
			error_reporting( E_ALL & ~ E_NOTICE );
		else
			error_reporting( 0 );
	}
	
	/**
	 * Boot
	 */
	private function boot() {
		$this->rewrite = new Rewrite();
	}
	
	/**
	 * Run
	 */
	public function run() {
		global $defaults;
		
		$this->query = new Query( $this->rewrite->parse() );
		
		$redirect_to = $this->query->getVar( 'redirect_to' );
		
		if( $redirect_to ) {
			$this->redirect( $redirect_to );
			exit();
		}
		
		$controller = $this->loadController( $this->query->getVar( 'controller', $defaults['controller'] ) );
		$method = $this->query->getVar( 'method', $defaults['method'] );
		$args = $this->query->getVar( 'args', array() );
		
		if( ! method_exists( $controller, $method ) )
			die( sprintf( 'Method %s doesn\'t exists in %s', $method, ( string ) @get_class( $controller ) ) );
		
		call_user_func_array( array( $controller, $method ), $args );
	}
	
	/**
	 * Load controller
	 *
	 * @param string $controller - Controller path, eg: folder/some-controller
	 */
	private function loadController( $controller ) {
		$controller = strtolower( $controller );
		
		if( !file_exists( ABSPATH . "/app/controllers/{$controller}.php" ) )
			return false;
		
		require_once( ABSPATH . "/app/controllers/{$controller}.php" );
		
		// eg. 'folder/some-controller' -> '\Controller\Some_Controller';
		$controller = '\\Controller\\' . str_replace( ' ', '_', ucwords( implode( ' ', explode( '-', end( explode( '/', $controller ) ) ) ) ) );
		
		if( !class_exists( $controller ) )
			return false;
		
		return new $controller();
	}
	
	/**
	 * Load model
	 *
	 * @param string $model - Model path, eg: folder/some-model
	 * @param array $args - Params to pass to Model's constructor (optional)
	 */
	public function loadModel( $model, $args = array() ) {
		$model = strtolower( $model );
		
		if( !file_exists( ABSPATH . "/app/models/{$model}.php" ) )
			return false;
		
		require_once( ABSPATH . "/app/models/{$model}.php" );
		
		// eg. 'folder/some-model' -> '\Model\Some_Model';
		$model = '\\Model\\' . str_replace( ' ', '_', ucwords( implode( ' ', explode( '-', end( explode( '/', $model ) ) ) ) ) );
		
		if( !class_exists( $model ) )
			return false;
		
		$model = new $model;
		
		if( method_exists( $model, '__construct' ) )
			call_user_func_array( array( $model, '__construct' ), $args );
		
		return new $model;
	}
	
	/**
	 * Load library
	 *
	 * As 3rd party libraries could have multiple classes and/or files.
	 *
	 * @param string $path - Library path
	 * @param string $class - Class name
	 * @param array $args - Params to pass to Library's constructor (optional)
	 */
	public function loadLibrary( $path, $class, $args = array() ) {
		if( !file_exists( ABSPATH . "/lib/{$path}.php" ) )
			return false;
		
		require_once( ABSPATH . "/lib/{$path}.php" );
		
		if( !class_exists( $class ) )
			return false;
		
		$library = new $class;
		
		if( method_exists( $library, '__construct' ) )
			call_user_func_array( array( $library, '__construct' ), $args );
		
		return new $library;
	}
	
	/**
	 * Redirect
	 *
	 * HTTP redirect
	 *
	 * @param string $location - Location
	 * @param int $status - HTTP/1.1 status code
	 * @return bool - False if $location is not set
	 */
	public function redirect( $location, $status = 302 ) {
		$location = preg_replace( '|[^a-z0-9-~+_.?#=&;,/:%!]|i', '', $location );
		
		if( ! $location )
			return false;
		
		header( "Location: $location", true, $status );
	}
}