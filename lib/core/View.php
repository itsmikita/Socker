<?php

/**
 * Really simple View class.
 */

namespace Sugar;

/**
 * Default View class
 */
class View {
	private $template, $args, $dependencies;
	
	/**
	 * Constructor
	 *
	 * @param string $filename - Filename
	 * @param array $deps - Dependencies (scripts/styles)
	 */
	public function __construct( $deps = array() ) {
		$this->dependencies = $deps;
	}
	
	/**
	 * Assing variable
	 *
	 * @param string $key - Variable key
	 * @param mixed $value - Variable value
	 */
	public function assign( $key, $value ) {
		$this->args[ $key ] = $value;
	}
	
	/**
	 * Render view
	 *
	 * @param string $filename - Filename
	 * @param mixed $args - Arguments to pass to template
	 */
	public function render( $filename, $args = array() ) {
		$this->args = array_merge( ( array ) $this->args, $args );
		
		extract( $this->args );
		
		include( ABSPATH . "/app/views/{$filename}.php" );
	}
	
	/**
	 * Get asset
	 */
	public function getAsset( $filename ) {
		extract( $this->args );
		
		include( ABSPATH . "/app/views/{$filename}.php" );
	}
	
	/**
	 * Get header
	 *
	 * @param string $suffix - Filename suffix
	 */
	public function getHeader( $suffix = '' ) {
		$this->getAsset( 'header' );
	}
	
	/**
	 * Get footer
	 *
	 * @param string $suffix - Filename suffix
	 */
	public function getFooter( $suffix = '' ) {
		$this->getAsset( 'footer' );
	}
	
	/**
	 * Set HTTP header
	 *
	 * @param int $code - HTTP Code (default 200)
	 */
	public function setHttpHeader( $code = 200 ) {
		// ...
	}
}