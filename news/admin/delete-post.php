<?php
include "config.php";
$pid = hex2bin($_GET['pid']);
$cid = hex2bin($_GET['cid']);

// echo $pid."<br>";
// echo $cid."<br>";

$fileDeleteSql = "SELECT * FROM post WHERE post_id = {$pid}";
$fileDeleteQuery = mysqli_query($connection, $fileDeleteSql) or die("File Delete Query Failed");
$row = mysqli_fetch_assoc($fileDeleteQuery);
unlink("../upload/".$row['post_img']);
// print_r($row);

// die();
$sql = "DELETE FROM post WHERE post_id={$pid};";
$sql .= "UPDATE category SET post= post-1 WHERE category_id = {$cid}";

// echo $sql;
$result = mysqli_multi_query($connection, $sql) or die("Query Failed");

if ($result) {
    header("location: {$mainUrl}admin/post.php");
} else {
    header("location: {$mainUrl}admin/post.php?msg=dfld");
}

?>