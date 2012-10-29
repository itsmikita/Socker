<?php

/**
 * Basically this is the Router, da URL wrapper. Now unknown syntax - use plain
 * Regular expressions when adding new rules. You can also tweak the priority.
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
	public function __construct() {}
	
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
				if( preg_match( '/^' . $route . '$/', $request_path, $matches ) )
					return preg_replace( '/^' . $route . '$/', $vars, $matches[0] );
		
		return '';
	}
	
	/**
	 * Get request path
	 */
	private function getRequestPath() {
		$uri = explode( '?', $_SERVER['REQUEST_URI'] );
		$path = '/' != PATH ? str_replace( PATH, '', $uri[0] ) : $uri[0];
		
		return $path;
	}
}