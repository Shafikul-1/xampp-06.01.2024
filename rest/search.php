<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";

$search = $_GET['search'];
$sql = "SELECT * FROM electronic_product WHERE name LIKE '%$search%'";

if ($result = mysqli_query($connection, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(array(
            'massage' => 'Your Search Result Not Found In Database',
            'status' => 404
        ));
    }
} else {
    echo json_encode(array(
        'massage' => 'Query Failed',
        'status' => 404
    ));
}
?>