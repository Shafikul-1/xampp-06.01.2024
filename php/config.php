<?php 
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName  = "news";
$conn = mysqli_connect($hostName, $userName, $password, $dbName) or die("Database Connect Failed");
?>