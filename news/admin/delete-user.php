<?php
include "config.php";
$id = hex2bin($_GET['id']);

$sql = "DELETE FROM users WHERE id={$id}";

$result = mysqli_query($connection, $sql) or die("Query Failed");

if ($result) {
    header("location: {$mainUrl}admin/users.php");
} else {
    header("location: {$mainUrl}admin/users.php?msg=dfld");
}
?>