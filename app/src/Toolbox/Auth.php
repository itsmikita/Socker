<?php
namespace Toolbox;

class Auth
{
	/**
	 * Check cookies
	 */
	public static function check()
	{
		if( empty( $_COOKIE[ AUTH_KEY ] ) || empty( $_COOKIE[ AUTH_ID ] ) )
			return false;
		
		if( $_COOKIE[ AUTH_KEY ] !== self::generate( $_COOKIE[ AUTH_ID ] ) )
			return false;
		
		return true;
	}
	
	/**
	 * Set cookies
	 *
	 * @param $id
	 */
	public function set( $id )
	{
		$key = self::generateHash( $id );
		
		setcookie( AUTH_ID, $id, time() + AUTH_LIFE, '/', $_SERVER['HTTP_HOST'] );
		setcookie( AUTH_KEY, $key, time() + AUTH_LIFE, '/', $_SERVER['HTTP_HOST'] );
		
		$_COOKIE[ AUTH_ID ] = $id;
		$_COOKIE[ AUTH_KEY ] = $key;
	}
	
	/**
	 * Clear cookies
	 */
	public static function clear()
	{
		unset( $_COOKIE[ AUTH_ID ] );
		unset( $_COOKIE[ AUTH_KEY ] );
		
		setcookie( AUTH_ID, null, -1, '/', $_SERVER['HTTP_HOST'] );
		setcookie( AUTH_KEY, null, -1, '/', $_SERVER['HTTP_HOST'] );
	}
	
	/**
	 * Generate hash
	 *
	 * @param string $string
	 */
	public static function generateHash( $string )
	{
		return crypt( $string, "$1$" . AUTH_SALT );
	}
	
}