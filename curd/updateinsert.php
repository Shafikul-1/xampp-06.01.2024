<?php 
$db_host = "localhost";
$db_user = "crud_data";
$db_password = "y26_sNJbs[g6MFId";
$db_name = "crud_data";

$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die ("Database Connection Error");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$address = $_POST['address'];
$class = $_POST['class'];

$query = "UPDATE student SET name = '{$name}', email= '{$email}', phone='{$number}', address='{$address}', class='{$class}' WHERE id='{$id}'";

$result = mysqli_query($connection, $query) or die( "Query Faild");




header("Location: index.php");
mysqli_close($connection);
?>