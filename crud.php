<?php

function addUser() {
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
		    "user",
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

function retrieveUser() {
	global $connection;

	$sql = "SELECT * FROM user";

	try
	{
		$statement = $connection->prepare($sql);
		$statement->execute();
		return $statement->fetchAll();
	}catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

function updateUser() {
	global $connection;

	try {

	    $sql = "UPDATE user
	    SET fullname = :fullname, username = :username, mykad = :mykad, email = :email, date_registered = :date_registered
	    WHERE id = :id";

		$statement = $connection->prepare($sql);
		$statement->bindParam(':fullname', $_POST['update-fullname'], PDO::PARAM_STR);
		$statement->bindParam(':username', $_POST['update-username'], PDO::PARAM_STR);
		$statement->bindParam(':mykad', $_POST['update-mykad'], PDO::PARAM_STR);
		$statement->bindParam(':email', $_POST['update-email'], PDO::PARAM_STR);
		$statement->bindParam(':date_registered', $_POST['update-date_registered'], PDO::PARAM_STR);
		$statement->bindParam(':id', $_POST['update-id'], PDO::PARAM_STR);
	    $statement->execute();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

function deleteUser() {
	global $connection;

	$id = $_POST['id'];
	$sql = sprintf("DELETE FROM user WHERE id = (%s)", $id);

	try {
		$statement = $connection->prepare($sql);
	    $statement->execute();
	    echo "<meta http-equiv='refresh' content='0'>";

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

function changePassword() {
	global $connection;
	try {
        $sql = "UPDATE user SET hash = :hash WHERE id = :id";

        $id = $_POST['change-pass-id'];
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $connection->prepare($sql);
        $statement->bindParam(':hash', $hash, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();

    } catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

if (isset($_POST['update'])) {
	updateUser();
}
if (isset($_POST['delete'])) {
	deleteUser();
}
if (isset($_POST['add'])) {
	addUser();
}
if (isset($_POST['change-pass'])) {
	changePassword();
}