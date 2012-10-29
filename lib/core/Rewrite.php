<?php

/**
 * This class works as a router. It uses URL to convert it
 * to query string that Query class uses to handle request.
 */

namespace Sugar;

/**
 * Default Rewrite class
 */
class Rewrite {
	private $rules = array();
	
	/**
	 * Constructor
	 */
	public __construct() {}
	
	/**
	 * Add rule
	 *
	 * @param string $route - Regex pattern (without leading and ending slash '/')
	 * @param string $vars - Query pattern
	 * @param string $priority - Wether add rule to the 'top' or 'bottom' of the $rules array (default 'bottom')
	 */
	public function addRule( $route, $vars, $priority = 'bottom' ) {
		$new_rule[ $route ] = $vars;
		
		if( 'top' == $priority )
			array_unshift( $this->rules, $new_rule );
		else
			array_push( $this->rules, $new_rule );
	}
	
	/**
	 * Remove rule
	 *
	 * @param string $route  Regex pattern to remove
	 */
	public function removeRule( $route ) {
		unset( $this->rules[ $route ] );
	}
	
	/**
	 * Parse URL
	 *
	 * Finds and parses query string.
	 */
	public function parse() {
		$request_path = $this->getRequestPath();
		
		foreach( $this->rules as $rule )
			foreach( $rule as $route => $vars )
				if( preg_match( '/^\/' . $route . '(\/)?$/', $request, $matches ) )
					return preg_replace( '/^\/' . $route . '(\/)?$/', $vars, $matches[0] );
		
		return '';
	}
	
	/**
	 * Get request path
	 */
	private getRequestPath() {
		$uri = explode( '?', $_SERVER['REQUEST_URI'] );
		$path = '/' != PATH ? str_replace( PATH, '', $uri[0] ) : $uri[0];
		
		return $path;
	}
}