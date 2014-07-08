<?php
require_once('SQLEngine.php');
/**
* A class to manage all referent to users
*/
class User
{
	private $sql;
	private $error;

	private $id;
	private $username;

	public $isLogged;

	function __construct()
	{
		$this->sql = new SqlEngine();
		$this->sql->connect();
		$this->isLogged = false;
	}

	function login($username, $password)
	{
		if(isset($username,$password))
		{
			if($this->sanitaze($username) && $this->sanitaze($password))
			{
				$query  = 'SELECT id, username ';
				$query .= 'FROM users ';
				$query .= 'WHERE username = "'.$username.'" AND password = "'.md5($password).'"';
				$result = $this->sql->query($query);
				if($result != 1)
				{			
					$this->isLogged = false;
					$this->error = $this->sql->getError();
				}
				else
				{
					if($this->sql->getRowsAffected() > 0 )
					{
						$row = mysql_fetch_array($this->sql->getQueryResult(), MYSQL_BOTH);
						$this->setUser($row);
						$this->isLogged = true;
					}
					else
					{
						$this->isLogged = false;
						$this->error .= "Err. Bad username/password combination";
					}
				}
			}
			else
			{
				$this->isLogged = false;
				$this->error = "Dont try to play with me >__>";
			}
		}
		else
		{
			$this->isLogged = false;
			$this->error = "Insufficient parameters";
		}
	}

	function setUser($row)
	{
		$this->id = $row["id"];
		$this->username = $row["username"];
	}

	function sanitaze($string)
	{
		// We should implement a method to clean the strings
		return true;
	}

	function getUsername()
	{
		return $this->username;
	}

	function getError()
	{
		return $this->error;
	}
}
?>