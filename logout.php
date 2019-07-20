<?php
session_start();
$_SESSION["loggedin"] = false;

header("Location: https://apps.amirasyraf.dev/mynett"); 
exit();