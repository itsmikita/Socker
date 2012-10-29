<?php

namespace Sugar;

/**
 * Default View class
 */
class View {
	private $template, $args;
	
	/**
	 * Constructor
	 */
	public function __construct( $filename ) {
		$this->filename = $template;
		$this->args = array();
	}
	
	/**
	 * Render view
	 *
	 * @param mixed $args - Arguments to pass to template
	 */
	public function render( $args = array() ) {
		$this->args = array_merge( $this->args, $args );
		
		extract( $this->args );
		
		include( ABSPATH . VIEWSPATH . "{$this->filename}.php" );
	}
	
	/**
	 * Set HTTP header
	 *
	 * @param int $code - HTTP Code (default 200)
	 */
	public function setHeader( $code = 200 ) {
		// ...
	}
}