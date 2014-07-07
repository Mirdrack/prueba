<?php
session_start();
$_SESSION['user'] = 'admin';
print_r($_SESSION);
?>