<?php

/**
 * Socker
 *
 * Write your application by extending \Socker\Application 
 * and include it down below.
 */

// Configuration
require_once( 'config.php' );

// Load application files
require_once( LIB . '/socker/application.php' );

// Run application
$app = new \Socker\Application();