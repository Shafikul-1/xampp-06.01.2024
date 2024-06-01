<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "chatapi";
$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database Connection Failed");
$mainUrl = "http://localhost/chatapi";
?>