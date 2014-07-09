<?php
require_once('Expense.php');
/**
* This class will manage an array of Expenses object instances
* in order to make the reports and some validations
*/
class Expenses
{
	private $sql;
	private $error;

	private $expenses;

	function __construct()
	{
		$this->sql = new SqlEngine();
		$this->sql->connect();
		$this->expenses = array();
	}

	public function getAllByVehicle($vehicleId)
	{
		$query  = 'SELECT * ';
		$query .= 'FROM expenses ';
		$query .= 'WHERE vehicle_id = '.$vehicleId.' ';
		$result = $this->sql->query($query);
		if($result == -1)
		{
			$this->error = $this->sql->geterror();
			return false;
		}
		else
		{
			if($this->sql->getRowsAffected() > 0 )
			{
				while($row = mysql_fetch_array($this->sql->getQueryResult(), MYSQL_BOTH))
				{
					$current = new Expense();
					$current->setExpense($row);
					array_push($this->expenses, $current);
				}
				return true;
			}
			else
			{
				$this->error = null;
				return false;
			}
		}		
	}

	public function validateKm($km, $vehicleId)
	{
		$query  = 'SELECT concept ';
		$query .= 'FROM expenses ';
		$query .= 'WHERE vehicle_id = '.$vehicleId. ' ';
		$query .= 'AND type = 2 ';
		$query .= 'ORDER BY id DESC LIMIT 1';
		$result = $this->sql->query($query);
		if($result == -1)
		{
			$this->error = "SQL Error: ".$this->sql->geterror();
			return false;
		}
		else
		{
			if($this->sql->getRowsAffected() > 0 )
			{
				$row = mysql_fetch_array($this->sql->getQueryResult(), MYSQL_BOTH);
				if($km > $row["concept"])
					return true;
				else
				{
					$this->error = 'Invalid Km';
					return false;
				}
			}
			else
			{
				$this->error = "No expenses";
				return false;
			}
		}
	}

	public function getExpenses()
	{
		$data = array();
		foreach ($this->expenses as $expense)
		{
			array_push($data, $expense->asArray());
		}
		return $data;
	}

	public function getError()
	{
		return $this->error;
	}
}
?>