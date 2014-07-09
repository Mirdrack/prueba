<?php
require_once('../classes/Expense.php');
$vehicleId 	= $_POST["vehicleId"];
$amount 	= $_POST["amount"];
$concept 	= $_POST["concept"];
$type 		= 3;
$expense = new Expense();

if($expense->add($vehicleId, $amount, $concept, $type))
{
	$data["errors"] = false;
	$data["expense"] = $expense->asArray();
}
else
{
	$data["errors"] = true;
	$data["error"] = $expense->getError();
}
header('Content-Type: application/json');
echo json_encode($data);
?>