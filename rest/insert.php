<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: ');
header('Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Header, Authorization');
include "config.php";

$requestInput = json_decode(file_get_contents("php://input"), true);
$name = $requestInput['name'];
$price = $requestInput['price'];
$color = $requestInput['color'];
$company_name = $requestInput['company_name'];
$person_name = $requestInput['person_name'];
$sql = "INSERT INTO electronic_product (name, price, color, company_name, person_name) VALUES ('{$name}',{$price},'{$color}','{$company_name}','{$person_name}')";
if (mysqli_query($connection, $sql)) {
    echo json_encode(array(
        'massage' => 'Data Insert Success',
        'status' => 200
    ));
} else {
    echo json_encode(array(
        'massage' => 'Data Insert Failed',
        'status' => 404
    ));
}
?>