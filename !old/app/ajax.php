<?php


/**
 * Example AJAX
 */
$app->get( '/ajax', function() use( $app ) {
	define( 'DOING_AJAX', true );
	header( 'Content-Type: application/json; charset=utf-8' );
	
	// Hello humans!
	$message = 'We\'re doing AJAX. Send me an action.';
	$response = compact( 'message' );
	
	// Ladies and children first
	if( ! empty( $_REQUEST['action'] ) ) {
		$response['message'] = 'We\'re doing AJAX.';
		$response = $app->doing( 'ajax_' . $_REQUEST['action'], $response );
	}
	
	// We're doing AJAX
	$response = $app->doing( 'ajax', $response );
	
	die( json_encode( $response ) );
} );
