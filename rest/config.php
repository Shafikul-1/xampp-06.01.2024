<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "product";

$connection = mysqli_connect($hostname,$username, $password, $dbname) or die("Database connection Error". mysqli_connect_error());
?>