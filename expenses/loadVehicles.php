<?php
error_reporting( E_ALL ); 
ini_set('display_errors', 1);
require_once('../classes/Vehicles.php');
$vehicles = new Vehicles();
if($vehicles->getAll())
{
	$data["errors"] = false;
	$data["vehicles"] = $vehicles->getVehicles();
}
else
{
	$data["errors"] = true;
	$data["error"] = $vehicles->getError();
}
header('Content-Type: application/json');
echo json_encode($data);
?>