<?php
require_once('../classes/Vehicle.php');
$plates =	$_POST["plates"];
$color = 	$_POST["color"];
$year = 	$_POST["year"];
$make = 	$_POST["make"];
$model = 	$_POST["model"];
$picture = 	uniqid().'.png';

$newVehicle = new Vehicle();
$added = $newVehicle->add($plates, $color, $year, $make, $model, $picture);
$uploaded = $newVehicle->uploadPicture($_FILES, $picture);
if($added && $uploaded)
{
	$data["registerd"] = true;
}
else
{
	$data["registerd"] = false;
	$data["error"] = $newVehicle->getError();
}
header('Content-Type: application/json');
echo json_encode($data);
?>