<?php
require_once('SQLEngine.php');
require_once('Expenses.php');
/**
* This class allow manage update functions and help
* when we need ask info of vehicles
*/
class Vehicle
{
	private $sql;
	private $error;

	private $id;
	private $plates;
	private $color;
	private $year;
	private $make;
	private $model;
	private $picture;

	private $expenses;

	function __construct()
	{
		$this->sql = new SqlEngine();
		$this->sql->connect();
		$this->expenses = array();
	}

	public function add($plates, $color, $year, $make, $model, $picture)
	{
		if(isset($plates, $color, $year, $make, $model, $picture))
		{
			$query  = 'INSERT INTO `vehicles`(`plates`, `color`, `year`, `make`, `model`, `picture`) VALUES (';
			$query .= '"'.$plates.'", ';
			$query .= '"'.$color.'", ';
			$query .= '"'.$year.'", ';
			$query .= '"'.$make.'", ';
			$query .= '"'.$model.'", ';
			$query .= '"'.$picture.'" )';
			$result = $this->sql->exeQuery($query);
			if($this->sql->getRowsAffected() > 0)
			{
				//$id = $this->sql->getLastId();
				//$this->setVehiclebyId($id);
				return true;
			}
			else
			{
				$this->error = "Error while insert the vehicle in DB";
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
		$query .= 'FROM vehicles ';
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
				$this->setVehicle($row);
				return true;
			}
			else
			{
				$this->error = "A vehicle with this id doesnt exist";
				return false;
			}
		}
	}

	public function uploadPicture($files, $filename)
	{
		if(isset($files['file']))
		{  
  			if(move_uploaded_file($files['file']['tmp_name'], "../files/" . $filename))
				return true;
  			else
  			{
  				$this->error = 'Failed to move the uploaded file';
  				return false;
  			}
		}
		else
		{
			$this->error = 'No file detected';
			return false;
		}
	}

	private function setExpenses()
	{
		$expenses = new Expenses();
		if($expenses->getAllByVehicle($this->id))
			return $expenses->getExpenses();
		else
			return $expenses->getError();
	}

	public function setVehicle($row)
	{
		$this->id		= $row["id"];
		$this->plates 	= $row["plates"];
		$this->color 	= $row["color"];
		$this->year 	= $row["year"];
		$this->make 	= $row["make"];
		$this->model 	= $row["model"];
		$this->picture 	= $row["picture"];
		$this->expenses  = $this->setExpenses();
	}

	public function asArray()
	{
		$data["id"] 		= $this->id;
		$data["plates"] 	= $this->plates;
		$data["color"] 		= $this->color;
		$data["year"] 		= $this->year;
		$data["make"]	 	= $this->make;
		$data["model"] 		= $this->model;
		$data["picture"] 	= $this->picture;
		$data["expenses"]	= $this->expenses;
		return $data;
	}

	/*function setVehiclebyId($id)
	{
		$this->id = $row["id"];
		$this->plates = $row["plates"];
	}*/

	public function getError()
	{
		return $this->error;
	}
}
?>