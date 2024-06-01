<?php 
$db_host = "localhost";
$db_user = "crud_data";
$db_password = "y26_sNJbs[g6MFId";
$db_name = "crud_data";

 $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die ("Database Connect Error");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $class = $_POST['class'];

    $query = "INSERT INTO student(name, email, address, phone, class) VALUES ('{$name}', '{$email}', '{$address}', '{$number}', '{$class}')" ;

    $result = mysqli_query($connection, $query) or die("Query UnsuccessFul");

    header("Location: index.php");

mysqli_close($connection);
?> 
