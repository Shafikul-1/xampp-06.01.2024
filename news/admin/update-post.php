<?php
include "config.php";
include "header.php";

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $oldCategory = mysqli_real_escape_string($connection, $_POST['oldCategory']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    if (empty($_FILES['files']['name'])) {
        $file_name = $_POST['oldFiles'];
    } else {
        $errors = array();
        // $file_name = $_FILES['files']['name'];
        $file_size = $_FILES['files']['size'];
        $file_tmp = $_FILES['files']['tmp_name'];
        $file_type = $_FILES['files']['type'];
        $fileExtension = end(explode('.', $_FILES['files']['name']));
        $file_ext = strtolower($fileExtension);
        
        $extensions = array("jpeg", "jpg", "png", "gif", "webp", "avif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Your File extension not allowed, please choose a jpeg jpg png gif webp avif file.";
        }

        if ($file_size > 10485760) {
            $errors[] = 'File size must be exactly 10 MB';
        }

        date_default_timezone_set('Asia/Dhaka');
        $dateCreate = date('d-m-y h_i_sA');

        if (empty($errors) == true){
            if (file_exists("../upload/".$_FILES['files']['name'])){
                $file_name = $dateCreate.$_FILES['files']['name'];
                move_uploaded_file($file_tmp, "../upload/$file_name");
                unlink("../upload/".$_FILES['files']['name']);

            }else{
                $file_name = $_FILES['files']['name'];
                move_uploaded_file($file_tmp, "../upload/".$file_name);
            }
        }else {
            print_r($errors);
        }
    }
    // echo "<br>";
    // echo $id . " ==> id<br>";
    // echo $title . " ==> title<br>";
    // echo $description . "==> description<br>";
    // echo $date . " ==> date<br>";
    // echo $file_name . " ==> file_name<br>";
    // echo $category . " ==>category <br>";
    // echo $oldCategory . "==> oldCategory<br>";

    $query = "UPDATE post SET title='{$title}', category={$category}, description='{$description}', post_date='{$date}', post_img='{$file_name}' WHERE post_id ={$id};";
    // $query = "UPDATE category SET post";
    if ($oldCategory != $category) {
        $query .= "UPDATE category SET post = post - 1 WHERE category_id = {$oldCategory}; ";
        $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}; ";
    }
    // echo $query;
    // die();
    $result = mysqli_multi_query($connection, $query) or die("Query Failed");

    if ($result) {
        header("location: {$mainUrl}admin/post.php");
    } else {
        echo "Query Failed";
    }
} else {
    header("location: {$mainUrl}admin/add-post.php?msg=ifailed");
}
