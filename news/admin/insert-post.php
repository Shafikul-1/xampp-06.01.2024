<?php
include "config.php";
include "header.php";

$author = $_SESSION['id'];
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    if(empty(isset($_POST['category']))){
        header("location: {$mainUrl}admin/add-post.php?msg=ctn");
    }else{
        $category = mysqli_real_escape_string($connection, $_POST['category']);
    }
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    if (isset($_FILES['files'])) {
        $errors = array();
        $file_name = $_FILES['files']['name'];
        $file_size = $_FILES['files']['size'];
        $file_tmp = $_FILES['files']['tmp_name'];
        $file_type = $_FILES['files']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'])));

        $extensions = array("jpeg", "jpg", "png", "gif", "webp", "avif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Your File extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 10485760) {
            $errors[] = 'File size must be exactly 10 MB';
        }

        date_default_timezone_set('Asia/Dhaka');
        $dateCreate = date('d-m-y h_i_sA');

        if (empty($errors) == true) {
            if (!file_exists("../upload/$file_name")) {
                move_uploaded_file($file_tmp, "../upload/$file_name");
                $query = "INSERT INTO post (title, category, description, post_date, author, post_img ) VALUES ('{$title}',{$category},'{$description}','{$date}',{$author},'{$file_name}');";
                $query .= "UPDATE category SET post = post + 1 WHERE category_id={$category}";
                // echo $query;
                // die();
                if (mysqli_multi_query($connection, $query)) {
                    header("location: {$mainUrl}admin/post.php");
                } else {
                    echo "Query Failed";
                }
            } else {
                move_uploaded_file($file_tmp, "../upload/$dateCreate$file_name");
                $query = "INSERT INTO post (title, category, description, post_date, author, post_img ) VALUES ('{$title}',{$category},'{$description}','{$date}',{$author},'{$dateCreate}{$file_name}');";
                $query .= "UPDATE category SET post = post + 1 WHERE category_id={$category}";
                // echo $query;
                // die();
                if (mysqli_multi_query($connection, $query)) {
                    header("location: {$mainUrl}admin/post.php");
                } else {
                    echo "Query Failed";
                }
            }
        } else {
            print_r($errors);
        }
    }
} else {
    header("location: {$mainUrl}admin/add-post.php?msg=ifailed");
}
