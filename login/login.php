<?php
require_once('../classes/User.php');

$username = $_POST["user"];
$password = $_POST["password"];
$myUser = new User();
$myUser->login($username, $password);
if($myUser->isLogged)
{
	$data["passed"] = true;
	session_start();
	$_SESSION['user'] = $myUser->getUsername();
}
else
{
	$data["passed"] = false;
	$data["error"] = $myUser->getError();
}

header('Content-Type: application/json');
echo json_encode($data);
?>