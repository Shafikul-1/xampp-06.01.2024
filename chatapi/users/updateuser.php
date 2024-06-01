<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";

$updateData = json_decode(file_get_contents("php://input"), true);
$id = htmlentities(mysqli_real_escape_string($connection, $updateData['id']));
$name = htmlentities(mysqli_real_escape_string($connection, $updateData['name']));
$username = htmlentities(mysqli_real_escape_string($connection, $updateData['username']));
$userImage = htmlentities(mysqli_real_escape_string($connection, $updateData['userImage']));
$password = htmlentities(mysqli_real_escape_string($connection, md5($updateData['password'])));
$confirmPassword = htmlentities(mysqli_real_escape_string($connection, md5($updateData['confirmPassword'])));

$sql = "SELECT id FROM users WHERE id = {$id}";
$query = mysqli_query($connection, $sql);
if (mysqli_num_rows($query) > 0) {

    $sql1 = "UPDATE users SET name='{$name}', username='{$username}', userImage ='{$userImage}', password='{$password}',confirmPassword='{$confirmPassword}' WHERE id = '{$id}'";
    $query1 = mysqli_query($connection, $sql1);
    if ($query1) {
        echo json_encode(array(
            "Status" => "Success",
        ));
    } else {
        echo json_encode(array(
            "Status" => "Failed",
        ));
    }
} else {
    echo json_encode(array(
        "Status" => "Failed",
        "error" => "Database data not found"
    ));
}
