<?php 
$db_host = "localhost";
$db_user = "crud_data";
$db_password = "y26_sNJbs[g6MFId";
$db_name = "crud_data";

$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("Databasse connection Failed");

$id = $_GET['id'];

$query = "DELETE FROM student WHERE id='{$id}'";

$result = mysqli_query($connection, $query) or die("Query Failed");

header("Location: index.php");
mysqli_close($connection);
?>