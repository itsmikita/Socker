<?php

/**
 * Sample page
 */
$app->get( '/', function() use( $app ) {
	$page_title = 'hello world!';
	$hello_world = ucfirst( $page_title );
	
	$app->view( 'hello.php', compact( 'page_title', 'hello_world' ) );
} );

