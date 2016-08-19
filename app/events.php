<?php

use Toolbox\Event;
use Toolbox\HTTP;

/**
 * Add template data
 *
 * @param array $data
 */
Event::on( 'template_data', function( $data = [] ) {
	
	
	return $data;
} );

