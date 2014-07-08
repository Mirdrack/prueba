<?php
require_once('../classes/Vehicle.php');
$id = $_POST["vehicleId"];
$vehicle = new Vehicle();
if($vehicle->setById($id))
{
	$data["errors"] = false;
	$data["vehicle"] = $vehicle->asArray();
}
else
{
	$data["errors"] = true;
	$data["error"] = $vehicle->getError();
}
header('Content-Type: application/json');
echo json_encode($data);
?>