<?php
namespace Toolbox;

use Prototypes\Singleton;
use Resources\Error_404;

class HTTP extends Singleton
{
	public $routes;
	public $params;
	
	/**
	 * Get current URI
	 */
	public static function getCurrentUri()
	{
		$uri = strtok( $_SERVER['REQUEST_URI'], '?' );
		
		if( empty( $uri ) )
			$uri = '/';
		
		return $uri;
	}
	
	/**
	 * Add event callback
	 *
	 * @param string $name
	 * @param mixed $callback
	 * @param mixed $priority
	 */
	public static function on( $name, $callback, $priority = null )
	{
		$http = self::get();
		
		if( ! is_array( $http->routes ) )
			$http->routes = [];
		
		if( ! isset( $http->routes[ $name ] ) )
			$http->routes[ $name ] = [];
		
		if( is_null( $priority ) )
			$http->routes[ $name ][] = $callback;
		
		else
			$http->routes[ $name ][ $priority ] = $callback;
	}
	
	/**
	 * Process HTTP request
	 */
	public static function process()
	{
		$http = self::get();
		
		foreach( $http->routes as $route => $callbacks ) {
			if( $http->is( $route ) )
				break;
			
			else
				$callbacks = null;
		}
		
		if( empty( $callbacks ) ) {
			Error_404::display();
			
			return false;
		}
		
		ksort( $callbacks );
		
		foreach( $callbacks as $callback )
			call_user_func( $callback, ( array ) $http->params );
	}
	
	/**
	 * Compare current URI to a path
	 *
	 * @param $path
	 * @param $params
	 */
	public static function is( $path )
	{
		// Support for multiple paths check
		$path = str_replace( [ "http://", "https://", $_SERVER['HTTP_HOST'] ], "", ( array ) $path );
		$http = self::get();
		
		if( 1 === preg_match( '/^' . str_replace( "/", "\/", join( "|", $path ) ) . "\/?$/i", self::getCurrentUri(), $http->params ) ) {
			if( !! $http->params )
				array_shift( $http->params );
			
			return true;
		}
		
		return false;
	}
}