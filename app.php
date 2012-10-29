<?php

define( 'SUGAR_VERSION', '0.1' );

/**
 * Load configuration
 */
require_once( 'config.php' );

/**
 * Load core classes
 */
require_once( 'lib/core/Application.php' );
require_once( 'lib/core/Rewrite.php' );
require_once( 'lib/core/Query.php' );
require_once( 'lib/core/Controller.php' );
require_once( 'lib/core/Model.php' );
require_once( 'lib/core/View.php' );

/**
 * Call this anything
 */
namespace App;

/**
 * User Application class
 */
class Application extends \Sugar\Application {
	
}
