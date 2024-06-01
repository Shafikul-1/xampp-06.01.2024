<?php 
    if (isset($_FILES['files'])) {
        echo "<pre>" ;
        print_r($_FILES);
        echo " </pre>";

$file_name = $_FILES['files']['name'];
$file_type = $_FILES['files']['type'];
$file_tem = $_FILES['files']['tmp_name'];
$file_size = $_FILES['files']['size'];


        if ($file_name === "upload/".$file_name) {
            echo "File Already Exit";
        } else {
            if (!move_uploaded_file($file_tem , "upload/".$file_name)) {
                echo "Upload Filed";
            } else {
                echo "File Upload Successful";
            }
        }

        
        
       
    }
    // echo "File upload complete";
?>