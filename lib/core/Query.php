<?php

namespace Sugar;

/**
 * Default Query class
 */
class Query {
	private $vars;
	
	/**
	 * Constructor
	 */
	public function __construct( $query ) {
		$this->parse( $query );
	}
	
	/**
	 * Parse query
	 */
	public function parse( $query ) {
		global $defaults;
		
		if( !is_array( $query ) )
			parse_str( $query, $vars );
		else
			$vars = $query;
		
		$this->vars = $vars;
	}
	
	/**
	 * Get query var
	 *
	 * @param string $key - Variable key
	 * @param mixed $default - Return this in case $key not found
	 */
	public function getVar( $key, $default = null ) {
		if( ! isset( $this->vars[ $key ] ) )
			return $default;
		
		return $this->vars[ $key ];
	}
	
	/**
	 * Set query var
	 *
	 * @param string $key - Variable key
	 * @param mixed $value - Variable value
	 */
	public function setVar( $key, $value ) {
		$this->vars[ $key ] = $value;
	}
}