<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Origin: *');// Replace with your frontend's origin if necessary
header('Access-Control-Allow-Methods: GET, OPTIONS'); // Adjust methods as needed
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$connection = mysqli_connect("localhost", "root", "", "chatapi") or die("Database Connection Failed");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, name, username, userImage FROM users WHERE id = $id";
} else {
    $sql = "SELECT id, name, username, userImage FROM users";
}

$query = mysqli_query($connection, $sql);
if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode(array(
            "Status" => 404,
            "Message" => "Database Data Not Found",
        ));
    }
} else {
    echo json_encode(array(
        "Status" => 404,
        "Message" => "Query Failed",
    ));
}
?>
