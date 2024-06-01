<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";
$DeleteData = json_decode(file_get_contents("php://input"), true);
$id = htmlentities(mysqli_real_escape_string($connection, $DeleteData['id']));

$sql = "SELECT id FROM users WHERE id = {$id}";
$query = mysqli_query($connection, $sql);
if (mysqli_num_rows($query) > 0) {

    $sql1 = "DELETE FROM users WHERE id = {$id}";
    $query1 = mysqli_query($connection, $sql1);
    if ($query1) {
        echo json_encode(array(
            "Status" => "Success",
        ));
    } else {
        echo json_encode(array(
            "Status" => "Failed"
        ));
    }
} else {
    echo json_encode(array(
        "Status" => "Failed",
        "error" => "Database data not found"
    ));
}
