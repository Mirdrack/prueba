<?php
require_once('../classes/Expenses.php');
$vehicleId = $_POST["vehicleId"];
$km = $_POST["km"];
$expenses = new Expenses();
if($expenses->validateKm($km, $vehicleId))
{
	$data["errors"] = false;
}
else
{
	$data["errors"] = true;
	$data["error"] = $expenses->getError();
}
header('Content-Type: application/json');
echo json_encode($data);
?>