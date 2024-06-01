<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header');
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$name = $data['name'];
$price = $data['price'];
$color = $data['color'];
$company_name = $data['company_name'];
$person_name = $data['person_name'];

 $sql = "UPDATE electronic_product SET name='{$name}',price={$price},color='{$color}',company_name='{$company_name}',person_name='{$person_name}' WHERE id = {$id}";

if (mysqli_query($connection, $sql)) {
    echo json_encode(array(
        'massage' => 'Data Update Success',
        'status' => 200
    ));
} else {
    echo json_encode(array(
        'massage' => 'Data Update Failed',
        'status' => 404
    ));
}

?>