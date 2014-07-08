<?php
/**
* A class to manage all the sql operations of the system
* Here we gonna set the data of the conection and the methods
* will manage the opertaions with the database
*/
class SqlEngine
{
	private $server;
	private $user;
	private $password;

	private $database;
	private $link;

	private $queryResult;
	private $rowsAfected;
	private $lastId;
	private $error;


	/**
	 * Set the propieties of the object with
	 * the default values
	 */
	function __construct()
	{
		$this->server = 'localhost';
		$this->user = 'root';
		$this->password = '';
		$this->database = 'prueba';
	}

	/**
	 * Connect whit default values to server.
	 * to an especific database.
	 * On error return false and set an string in the error member.
	 * @return bool
	 */
	public function connect()
	{
		$link = mysql_connect($this->server, $this->user, $this->password);
		if (!$link)
		{
		    $this->error = 'Err: Server conection error.'.mysql_error();
		    return false;
		}
		else
		{
			$dbSelected = mysql_select_db($this->database, $link);
			if (!$dbSelected)
			{
	    		$this->error = 'Err: Cannot connect to the Databse. '. mysql_error();
	    		return false;
			}			
			$this->link = $link;
			mysql_set_charset("utf8",$link);
			return true;
		}
	}

	/**
	* Close the connection and return a bool value
	* On error the method set an string with in the error member.
	* @return bool
	*/
	public function close()
	{
		$isClosed = mysql_close($this->link);
		if(!$isClosed)
		{
			$this->error =  "Err. Cannot close the connection. ". mysql_error();
			return false;
		}
		else
			return true;
	}

	/**
	 * This method execute the query and return the result.
	 * On error return an string with error.
	 * @param  string $queryString
	 * @return int {error: -1, no_results: 0, success: 1}
	 */
	public function query($queryString = null)
	{
		//echo $queryString;
		$result = mysql_query($queryString);
		if (!$result)
		{
		    $this->error =  'Invalid query: ' . $queryString. mysql_error();
		    return -1;
		}
		else
		{
			$this->rowsAfected = mysql_num_rows($result);
			if(mysql_num_rows($result) > 0)
			{
				$this->queryResult = $result;
				return 1;
			}
			else
				return 0; // No Error but SELECT is empty
		}
	}

	/**
	 * This method is similar to query but is used on query
	 * to insert, delete or update
	 * @param  string $queryString [description]
	 * @return int {error: -1, no_results: 0, success: 1}
	 */
	public function exeQuery($queryString = null)
	{
		$result = mysql_query($queryString);
		if (!$result)
		{
		    $this->error =  'Invalid query: ' . $queryString. mysql_error();
		    return -1;
		}
		else
		{
			$this->rowsAfected = mysql_affected_rows($this->link);
			if(mysql_affected_rows($this->link) > 0)
			{
				$this->queryResult = $result;
				$this->lastId = mysql_insert_id($this->link);
				return 1;
			}
			else
				return 0; // No Error but result is empty
		}
	}

	public function escape($string)
	{
		return mysql_real_escape_string($string);
	}

	public function getQueryResult()
	{
		return $this->queryResult;
	}

	public function getRowsAffected()
	{
		return $this->rowsAfected;
	}

	public function getLastId()
	{
		return $this->lastId;
	}

	public function getError()
	{
		return $this->error;
	}

	public function setDatabase($database)
	{
		$this->database = $database;
	}
}
?>