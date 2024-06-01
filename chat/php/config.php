<?php 
$hostname = "localhost";
$username = "root";
$password  = "";
$dbname = "chat";
$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database Connection Error");

$mainUrl = "http://localhost/chat";
?>