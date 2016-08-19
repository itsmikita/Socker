<?php

/**
 * PSR-4 compatible autoloader
 *
 * @param string $path
 */
spl_autoload_register( function( $path ) {
	$path = str_replace( "\\", "/", $path );
	$file = ABSPATH . "/app/src/{$path}.php";
	
	if( ! file_exists( $file ) )
		return;
	
	require_once $file;
} );
