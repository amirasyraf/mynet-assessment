<?php
session_start();
$_SESSION["loggedin"] = false;

header("Location: https://apps.amirasyraf.dev/php-crud/login.php"); 
exit();