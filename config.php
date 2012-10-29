<?php

/**
 *
 */

/**
 * Debuging
 *
 * 1 - On, will print all errors to browser
 * 0 - Off
 */
define( 'DEBUG', 1 );

/**
 * Absolute path
 */
define( 'ABSPATH', realpath( dirname( __FILE__ ) ) );

/**
 * Domain
 */
define( 'DOMAIN', $_SERVER['HTTP_HOST'] );

/**
 * Path
 */
define( 'PATH', '/sugar' );

/**
 * Defaults
 */
$defaults = array();

/**
 * Default controller name
 */
$defaults['controller'] = 'Home';

/**
 * Default method name
 */
$defaults['method'] = 'index';
