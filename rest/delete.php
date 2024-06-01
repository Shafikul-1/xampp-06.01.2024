<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";

$id = $_GET['id'];
$sql = "DELETE FROM electronic_product WHERE id = {$id}";
if (mysqli_query($connection, $sql)) {
    echo json_encode(array(
        'massage' => 'Data Delete Success',
        'status' => 200
    ));
} else {
    echo json_encode(array(
        'massage' => 'Data Delete Failed',
        'status' => 404
    ));
}
?>