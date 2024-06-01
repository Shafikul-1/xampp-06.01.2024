<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');

include "config.php";
$uniqueId = rand(date("his"), 1000000);

$userData = json_decode(file_get_contents("php://input"), true);
$name = htmlentities(mysqli_real_escape_string($connection, $userData['name']));
$username = htmlentities(mysqli_real_escape_string($connection, $userData['username']));
$userImage = htmlentities(mysqli_real_escape_string($connection, $userData['userImage']));
$password = htmlentities(mysqli_real_escape_string($connection, md5($userData['password'])));
$confirmPassword = htmlentities(mysqli_real_escape_string($connection, md5($userData['confirmPassword'])));

$sql = "INSERT INTO users(uniqueId, name, username, userImage, password, confirmPassword) VALUES ({$uniqueId},'{$name}','{$username}','{$userImage}','{$password}','{$confirmPassword}')";

$query = mysqli_query($connection, $sql);
if ($query) {
    echo json_encode(array(
        "Status" => "Success",
    ));
} else {
    echo json_encode(array(
        "Status" => "Failed",
    ));
}
