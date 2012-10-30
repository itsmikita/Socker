<?php

/**
 * Really simple View class.
 */

namespace Socker;

/**
 * Default View class
 */
class View {
	private $template;
	private $args;
	private $dependencies;
	
	/**
	 * Constructor
	 *
	 * @param array $deps - Dependencies (scripts/styles)
	 */
	public function __construct( $deps = array() ) {
		$this->dependencies = $deps; // TODO:
	}
	
	/**
	 * Assign variable
	 *
	 * @param string $key - Variable key
	 * @param mixed $value - Variable value
	 */
	public function setKey( $key, $value ) {
		$this->args[ $key ] = $value;
	}
	
	/**
	 * Remove variable
	 *
	 * @param string $key - Variable key
	 * @param mixed $value - Variable value
	 */
	public function removeKey( $key ) {
		if( isset( $this->args[ $key ] ) )
			unset( $this->args[ $key ] );
	}
	
	/**
	 * Render view
	 *
	 * @param string $filename - Filename
	 * @param mixed $args - Arguments to pass to template
	 */
	public function render( $filename, $args = array() ) {
		$this->args = array_merge( ( array ) $this->args, $args );
		
		$this->getAsset( $filename );
	}
	
	/**
	 * Get asset
	 */
	public function getAsset( $filename ) {
		if( ! file_exists( ABSPATH . "/app/views/{$filename}.php" ) )
			return false;
		
		extract( $this->args );
		
		include( ABSPATH . "/app/views/{$filename}.php" );
	}
	
	/**
	 * Get header
	 *
	 * @param string $suffix - Filename suffix
	 */
	public function getHeader( $suffix = '' ) {
		$filename = 'header';
		
		if( $suffix )
			$filename = "header-{$suffix}";
		
		$this->getAsset( $filename );
	}
	
	/**
	 * Get footer
	 *
	 * @param string $suffix - Filename suffix
	 */
	public function getFooter( $suffix = '' ) {
		$filename = 'footer';
		
		if( $suffix )
			$filename = "footer-{$suffix}";
		
		$this->getAsset( $filename );
	}
	
	/**
	 * Set HTTP header
	 *
	 * @param int $code - HTTP Code (default 200)
	 */
	public function setHttpHeader( $code = 200 ) {
		// TODO:
	}
}