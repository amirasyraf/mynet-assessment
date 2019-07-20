<?php

require_once 'database.php';

$userId = $_POST['userId'];

$sql = "SELECT * FROM member WHERE id = :userId";

$statement = $connection->prepare($sql);
$statement->bindParam(':userId', $userId, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();

echo json_encode($result);