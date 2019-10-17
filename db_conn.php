<?php

$configVariables = include ('config.php');

$dbUserName = $configVariables['db_username'];
$dbPassword = $configVariables['db_password'];
$dbName = $configVariables['db_name'];

$connection = new mysqli('localhost', $dbUserName, $dbPassword, $dbName);

if ($connection->connect_error) {
    die('Error : (' . $connection->connect_errno . ') ' . $connection->connect_error);
}