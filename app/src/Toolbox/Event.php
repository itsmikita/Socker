<?php
namespace Toolbox;

use Prototypes\Singleton;

class Event extends Singleton
{
	public $callbacks = [];
	
	/**
	 * Add event callback
	 *
	 * @param $name
	 * @param $callback
	 * @param $priority
	 */
	public static function on( $name, $callback, $priority = null )
	{
		$handler = self::get();
		
		if( ! isset( $handler->callbacks[ $name ] ) )
			$handler->callbacks[ $name ] = [];
		
		if( is_null( $priority ) )
			$handler->callbacks[ $name ][] = $callback;
		
		else
			$handler->callbacks[ $name ][ $priority ] = $callback;
	}
	
	/**
	 * Trigger event callbacks
	 */
	public static function trigger( $name )
	{
		$handler = self::get();
		$params = func_get_args();
		
		// Pop the event name off
		array_shift( $params );
		
		if( ! empty( $handler->callbacks[ $name ] ) ) {
			$callbacks = $handler->callbacks[ $name ];
			
			ksort( $callbacks );
			
			foreach( $callbacks as $callback )
				$params[ 0 ] = call_user_func_array( $callback, $params );
			
			return $params[ 0 ];
		}
		else
			return isset( $params[ 0 ] ) ? $params[ 0 ] : null;
	}
}