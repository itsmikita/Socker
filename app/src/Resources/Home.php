<?php
namespace Resources;

use Prototypes\View;

class Home extends View
{
	/**
	 * Display view
	 */
	static public function display()
	{
		print self::render( 'home' );
	}
}