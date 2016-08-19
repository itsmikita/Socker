<?php
namespace Toolbox;

use Prototypes\Singleton;
use PDO;

class DB extends Singleton
{
	/**
	 * Get singleton PDO instance
	 */
	public static function get()
	{
		static $pdo = null;
		
		if( null == $pdo )
			$pdo = new PDO( "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4", DBUSER, DBPSWD, [
				PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
			] );
		
		return $pdo;
	}
	
	/**
	 * Passes on any static calls to this class onto the singleton PDO instance
	 * (Idea from: http://php.net/manual/en/book.pdo.php#93178)
	 *
	 * @param string $method
	 * @param array $params
	 */
	final public static function __callStatic( $method, $params )
	{
		$pdo = self::get();
		
		if( "lastInsertId" == $method )
			return $statement;
		
		return call_user_func_array( [ $pdo, $method ], $params );
	}
}