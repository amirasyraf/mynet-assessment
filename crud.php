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
}

function deleteMember() {
}

if (isset($_POST['update'])) {
}
if (isset($_POST['delete'])) {
}
