<?php
namespace Resources;

use Prototypes\View;

class Error_404 extends View
{
	/**
	 * Display view
	 */
	static public function display()
	{
		print self::render( 'errors/404' );
	}
}