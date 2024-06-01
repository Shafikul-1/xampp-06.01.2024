<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "news";
$mainUrl = "http://localhost/news/";
$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database Connection Failed");
?>