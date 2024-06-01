<?php 
include "config.php";
//File Get Name & Name Replace
$other_url = $_POST['other_url'];
$description = $_POST['description'];

$path_name = $_POST['path_name'];
$pattern = '/[*":\';?\/><|\\\\]/';
$complete_file_name = preg_replace($pattern, '-', $path_name);


if ($path_name == "") {
    header("Location: upload_image.php?msg=efn");
} else {
    if (!file_exists("uploads/".$complete_file_name)){
        if (mkdir("uploads/".$complete_file_name)){
            if (isset($_FILES['files'])) {
                #Multiple File Upload code...
                $fileCount = count($_FILES['files']['name']);
                for ($i=0; $i < $fileCount; $i++) { 
                    $file_name = $_FILES['files']['name'][$i];
                    $file_size = $_FILES['files']['size'][$i];
                    $file_tmp = $_FILES['files']['tmp_name'][$i];
                    $file_type = $_FILES['files']['type'][$i];
                    if ($file_tmp != ""){
                        
                        if(move_uploaded_file($file_tmp, "./uploads/".$complete_file_name."/" . $_FILES['files']['name'][$i])) {
                            $query = "INSERT INTO imageupload (filename, other_url, description, folder_name) VALUES ('{$file_name}','{$other_url}','{$description}','{$complete_file_name}')";

                            if (mysqli_query($connection, $query)) {
                                header("Location: index.php");
                            } else {
                               echo "Query Failed";
                            }
                        } else {
                            echo "File Upload Failed";
                        }
                    } else{
                        echo "Temp File Is Emty";
                    }
                }
            }
        }else{
            header("Location: upload_image.php?msg=fcf");
        }
    }else{
        header("Location: upload_image.php?msg=fex");
    }
}
?>
