<?php
namespace Prototypes\DB;

use Toolbox\DB;
use PDO;

class Record
{
	public static public function get( $params = [] )
	{
		$table = get_called_class();
		
		die( var_dump( $table ) );
		
	}
}