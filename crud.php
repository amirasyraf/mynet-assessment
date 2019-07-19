<?php

function addMember() {
}

function retrieveMember() {
	global $connection;

	$sql = "SELECT * FROM member";

	try
	{
		$statement = $connection->prepare($sql);
		$statement->execute();
		return $statement->fetchAll();
	}catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

function updateMember() {
	global $connection;

	try {

	    $sql = "UPDATE member
	    SET fullname = :fullname, mykad = :mykad, email = :email, date_registered = :date_registered
	    WHERE id = :id";

		$statement = $connection->prepare($sql);
		$statement->bindParam(':fullname', $_POST['fullname'], PDO::PARAM_STR);
		$statement->bindParam(':mykad', $_POST['mykad'], PDO::PARAM_STR);
		$statement->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$statement->bindParam(':date_registered', $_POST['date_registered'], PDO::PARAM_STR);
		$statement->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
	    $statement->execute();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	} 
}

function deleteMember() {
}

if (isset($_POST['update'])) {
}
if (isset($_POST['delete'])) {
}
