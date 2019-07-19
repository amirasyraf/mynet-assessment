<?php

function addMember() {
	global $connection;

	try {
		$data = array(
			"fullname" => $_POST['add-fullname'],
	        "mykad"  => $_POST['add-mykad'],
	        "email"     => $_POST['add-email'],
	        "date_registered"       => $_POST['add-date_registered']
	    );

	    $sql = sprintf(
	    	"INSERT INTO %s (%s) VALUES (%s)",
		    "member",
		    implode(", ", array_keys($data)),
		    ":" . implode(", :", array_keys($data))
		);

		$statement = $connection->prepare($sql);
	    $statement->execute($data);
	    echo "<meta http-equiv='refresh' content='0'>";
	}

	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
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
		$statement->bindParam(':fullname', $_POST['update-fullname'], PDO::PARAM_STR);
		$statement->bindParam(':mykad', $_POST['update-mykad'], PDO::PARAM_STR);
		$statement->bindParam(':email', $_POST['update-email'], PDO::PARAM_STR);
		$statement->bindParam(':date_registered', $_POST['update-date_registered'], PDO::PARAM_STR);
		$statement->bindParam(':id', $_POST['update-id'], PDO::PARAM_STR);
	    $statement->execute();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

function deleteMember() {
	global $connection;

	if (isset($_POST['delete'])) { 
		$id = $_POST['id'];
		echo $id;
		$sql = sprintf("DELETE FROM member WHERE id = (%s)", $id);

		try {
			$statement = $connection->prepare($sql);
		    $statement->execute();
		    echo "<meta http-equiv='refresh' content='0'>";
		}

		catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
}

if (isset($_POST['update'])) {
	updateMember();
}
if (isset($_POST['delete'])) {
	deleteMember();
}
if (isset($_POST['add'])) {
	addMember();
}