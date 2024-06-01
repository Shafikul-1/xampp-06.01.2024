<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";
$search = $_GET['search'];

$sql = "SELECT id,name, username, userImage FROM users WHERE name LIKE '%$search%'";
$query = mysqli_query($connection, $sql);
if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode(array(
            "Status" => 404,
            "Massage" => "Database Data Not Found",
        ));
    }
} else {
    echo json_encode(array(
        "Status" => 404,
        "Massage" => "Query Failed",
    ));
}
