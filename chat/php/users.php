<?php 
include "config.php";
include "header.php";

$sql = "SELECT * FROM users ";
$output = '';
$result = mysqli_query($connection, $sql) or die("Query FAiled");
if (mysqli_num_rows($result) == 1) {
    $output .= 'No User Avavle chat';
} else if (mysqli_num_rows($result) > 0) {
    include "alluser.php";
}
echo $output;

?>