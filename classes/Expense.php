<?php
require_once('SQLEngine.php');
/**
* This class ...
*/
class Expense
{
	private $sql;
	private $error;

	private $id;
	private $vehicleId;
	private $amount;
	private $concept;
	private $type;

	function __construct()
	{
		$this->sql = new SqlEngine();
		$this->sql->connect();
	}

	public function add($vehicleId, $amount, $concept, $type)
	{
		if(isset($vehicleId, $amount, $concept, $type))
		{
			$query  = 'INSERT INTO `expenses`(`vehicle_id`, `amount`, `concept`, `type`) VALUES (';
			$query .= ' '.$vehicleId.', ';
			$query .= ' '.$amount.', ';
			$query .= '"'.$concept.'", ';
			$query .= ' '.$type.' )';
			$result = $this->sql->exeQuery($query);
			if($this->sql->getRowsAffected() > 0)
			{
				$id = $this->sql->getLastId();
				$this->setById($id);
				return true;
			}
			else
			{
				$this->error = "Error while insert the vehicle in DB.";
				return false;
			}
		}
		else
		{
			$this->error = 'Not enougth parameters';
			return false;
		}
	}

	public function setById($id)
	{
		$query  = 'SELECT * ';
		$query .= 'FROM expenses ';
		$query .= 'WHERE id = "'.$id.'"';
		$result = $this->sql->query($query);
		if($result != 1)
		{
			$this->error = $this->sql->getError();
			return false;
		}
		else
		{
			if($this->sql->getRowsAffected() > 0 )
			{
				$row = mysql_fetch_array($this->sql->getQueryResult(), MYSQL_BOTH);
				$this->setExpense($row);
				return true;
			}
			else
			{
				$this->error = "A vehicle with this id doesnt exist";
				return false;
			}
		}
	}

	public function setExpense($row)
	{
		$this->id			= $row["id"];
		$this->vehicleId 	= $row["vehicle_id"];
		$this->amount 		= $row["amount"];
		$this->concept 		= $row["concept"];
		$this->type 		= $row["type"];
	}

	public function asArray()
	{
		$data["id"]			= $this->id;
		$data["vehicle_id"]	= $this->vehicleId;
		$data["amount"]		= $this->amount;
		$data["concept"]	= $this->concept;
		$data["type"]		= $this->type;
		return $data;
	}

	public function getError()
	{
		return $this->error;
	}
}
?>