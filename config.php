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
define( 'PATH', '/' );

/**
 * Database settings
 */
define( 'DBHOST', 'localhost' );
define( 'DBUSER', 'root' );
define( 'DBPASS', 'root' );
define( 'DBNAME', 'sugar' );
define( 'PREFIX', '' );

/**
 * Password salt
 */
define( 'AUTH_SALT', 'dY=EO6fj+qPuUA1@7{ep^0]X>|b:u|HN,BIB[P$!zE*nmU#5S[TZ=gfiURbw;*m!' );

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
