<?php

$host = "localhost";
$username = "amir";
$password = "";
$dbname = "mynet";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

try {
	$connection = new PDO($dsn, $username, $password, $options);
} 

catch(PDOException $error) {

	echo $sql . "<br>" . $error->getMessage();
}
