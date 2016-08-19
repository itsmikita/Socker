<?php

namespace Socker;

class Database {
	var $prefix;
	var $dbh;
	var $last_query;
	var $rows_affected;
	var $insert_id;
	var $start_time;
	var $query_time;
	
	/**
	 * Constructor
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $database
	 * @param string $host
	 */
	public function __construct( $username = '', $password = '', $database = '', $host = '' ) {
		$this->connect( $username, $password, $database, $host );
	}
	
	/**
	 * Connect
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $database
	 * @param string $host
	 */
	public function connect( $username, $password, $database, $host ) {
		try {
			$this->dbh = new \PDO( "mysql:dbname=$database;host=$host", $username, $password );
			$this->dbh->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
			$this->dbh->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
		}
		catch( \PDOException $e ) {
			die( 'Connection failed: ' . $e->getMessage() );
		}
	}
	
	/**
	 * Set prefix
	 */
	public function setPrefix( $prefix ) {
		$this->prefix = $prefix;
	}
	
	/**
	 * Add table
	 */
	public function addTable( $name ) {
		$table = "{$this->prefix}$name";
		
		if( ! isset( $this->$name ) )
			$this->$name = $table;
	}
	
	/**
	 * Query
	 *
	 * @param string $query
	 * @param array $args
	 */
	public function query( $query, $args = array() ) {
		$this->last_query = $query;
		$this->insert_id = null;
		$this->rows_affected = 0;
		
		if( $args )
			$args = $this->_prepareArgs( $args );
		
		$this->_startTimer();
		
		try {
			$sth = $this->dbh->prepare( $query );
			$sth->execute( $args );
		}
		catch( \PDOException $e ) {
			die( 'Error: ' . $e->getMessage() . '<br />' . 'Query: ' . $this->last_query );
		}
		
		if( preg_match( "/^INSERT/si", $query ) )
			$this->insert_id = $this->dbh->lastInsertId();
		
		if( preg_match( "/^(INSERT|UPDATE)/si", $query ) )
			$this->rows_affected = $sth->rowCount();
		
		$this->_stopTimer();
		
		if( $this->insert_id )
			return $this->insert_id;
		
		return $sth;
	}
	
	/**
	 * Prepare arguments for DBOStatement::execute()
	 *
	 * @param array $args
	 */
	private function _prepareArgs( $args ) {
		if( ! $this->_isAssoc( $args ) )
			return $args;
		
		$_new_args = array();
		
		foreach( $args as $key => $value )
			if( is_string( $key ) )
				$_new_args[ ":$key" ] = $value;
		
		return $_new_args;
	}
	
	/**
	 * Is associative array?
	 *
	 * @param array $array
	 */
	private function _isAssoc( $array ) {
		if( ! is_array( $array ) )
			return false;
		
		foreach( array_keys( $array ) as $key )
			if( is_string( $key ) )
				return true;
		
		return false;
	}
	
	/**
	 * Get results
	 *
	 * @param string $query
	 * @param const $type - \PDO::FETCH_OBJ, \PDO::FETCH_ASSOC or \PDO::FETCH_NUM
	 */
	public function getResults( $query, $type = \PDO::FETCH_OBJ ) {
		$sth = $this->query( $query );
		
		$sth->fetchAll( $type );
		
		return $results;
	}
	
	/**
	 * Get row
	 *
	 * @param string $query
	 * @param const $type
	 * @param int $y
	 */
	public function getRow( $query, $type = \PDO::FETCH_OBJ, $y = 0 ) {
		$results = $this->getResults( $query, $type );
		
		return $results[ $y ];
	}
	
	/**
	 * Get var
	 *
	 * @param string $query
	 * @param int $x
	 * @param int $y
	 */
	public function getVar( $query, $x = 0, $y = 0 ) {
		$results = $this->getResults( $query, \PDO::FETCH_NUM );
		
		return $results[ $x ][ $y ];
	}
	
	/**
	 * Get insert id
	 */
	public function insertId() {
		return $this->insert_id;
	}
	
	/**
	 * Close connection
	 */
	public function close() {
		$this->dbh = null;
	}
	
	/**
	 * Get current miccrotime
	 */
	public function _getCurrentTime() {
		list( $usec, $sec ) = explode( ' ', microtime() );
		return ( float ) $usec + ( float ) $sec;
	}
	
	/**
	 * Start timer
	 */
	public function _startTimer() {
		$this->start_time = $this->_getCurrentTime();
	}
	
	/**
	 * Stop timer
	 */
	public function _stopTimer() {
		$this->query_time =  $this->_getCurrentTime() - $this->start_time;
	}
}
