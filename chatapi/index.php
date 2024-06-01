<?php echo "Chat API <br>";
include "admin/config.php";

$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
print_r(json_decode($jsonobj));
 
// $connection = mysqli_connect("localhost", "root", "", "chatapi") or die("Database Connection Failed");
?>
 
// $connection = mysqli_connect("localhost", "root", "", "chatapi") or die("Database Connection Failed");
// header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, OPTIONS');
// header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');
// // include "config.php";

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql = "SELECT id, name, username, userImage FROM users WHERE id = $id";
// } else {
//     $sql = "SELECT id, name, username, userImage FROM users";
// }

// $query = mysqli_query($connection, $sql);
// if ($query) {
//     if (mysqli_num_rows($query) > 0) {
//         $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
//         echo json_encode($result);
//     } else {
//         echo json_encode(array(
//             "Status" => 404,
//             "Massage" => "Database Data Not Found",
//         ));
//     }
// } else {
//     echo json_encode(array(
//         "Status" => 404,
//         "Massage" => "Query Failed",
//     ));
// }
