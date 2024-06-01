<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";

// $id = json_decode(file_get_contents("php://input"), true);
// if (isset($_GET['id'])) {
//     $sql = "SELECT * FROM electronic_product WHERE id = {$_GET['id']}";
// } else {
//     $sql = "SELECT * FROM electronic_product";
// }

$sql = (isset($_GET['id'])) ? "SELECT * FROM electronic_product WHERE id = {$_GET['id']}" :"SELECT * FROM electronic_product" ;

if ($result = mysqli_query($connection, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($fetch);
    } else {
        echo json_encode(
            array(
                "massage" => "Database Data not Found",
                "status" => 404
            )
        );
    }
} else {
    echo json_encode(
        array(
            "massage" => "Query Failed",
            "status" => 404
        )
    );
}
