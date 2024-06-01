<?php 
$id = $_GET['id'];
    $connect = mysqli_connect("localhost", "root", "", "crud2") or die("Database Connect Error");
    $sql = "DELETE FROM crud WHERE id={$id}";
    mysqli_query($connect, $sql) or die("Query Faild");

    header("Location: index.php");

    mysqli_close($connect);
?>