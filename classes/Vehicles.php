<?php
require_once('Vehicle.php');
/**
* This class will manage an array of Vehicles object instances
*/
class Vehicles
{
	private $sql;
	private $error;

	private $vehicles;

	function __construct()
	{
		$this->sql = new SqlEngine();
		$this->sql->connect();
		$this->vehicles = array();
	}

	public function getAll()
	{
		$query  = 'SELECT *';
		$query .= 'FROM vehicles ';
		$result = $this->sql->query($query);
		if($result != 1)
		{
			return false;
			$this->error = $this->sql->geterror(); // This will send an error to up level
		}
		else
		{
			if($this->sql->getRowsAffected() > 0 )
			{
				while($row = mysql_fetch_array($this->sql->getQueryResult(), MYSQL_BOTH))
				{
					$current = new Vehicle();
					$current->setVehicle($row);
					array_push($this->vehicles, $current);
				}
				return true;
			}
			else
			{
				$this->error = "No vehicles";
				return false;
			}
		}		
	}

	public function getVehicles()
	{
		$data = array();
		foreach ($this->vehicles as $vehicle)
		{
			array_push($data, $vehicle->asArray());
		}
		return $data;
	}

	public function getError()
	{
		return $this->error;
	}
}
?>