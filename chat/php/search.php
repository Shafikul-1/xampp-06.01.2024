<?php 
include "config.php";

$search = mysqli_real_escape_string($connection, $_POST['search']);
$output = '';
$sql = "SELECT * FROM users WHERE username LIKE '%{$search}%'";
$result = mysqli_query($connection, $sql) or die('Quer FAiled');
if (mysqli_num_rows($result) > 0) {
    include "alluser.php";
} else {
    echo $output .= 'Your search result not found in database';
}
echo $output;
?>