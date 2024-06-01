<?php
include "header.php";
include "config.php";
$username = mysqli_real_escape_string($connection, $_POST['username']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$pass = md5(mysqli_real_escape_string($connection, $_POST['pass']));
$repass = md5(mysqli_real_escape_string($connection, $_POST['repass']));

if (!empty($username) && !empty($email) && !empty($pass) && !empty($repass)) {
    // echo $name."<br>".$email."<br>".$pass."<br>".$repass."<br>";
    if ($pass == $repass) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $emailCheckSql = "SELECT email FROM users WHERE email = '{$email}'";
            if ($emailResult = mysqli_query($connection, $emailCheckSql)) {

                if (mysqli_num_rows($emailResult) > 0) {
                    echo "$email - Already Exits";
                } else {
                    if (isset($_FILES['file'])) {
                        $fileName = $_FILES['file']['name'];
                        $fileType = $_FILES['file']['type'];
                        $fileTemp = $_FILES['file']['tmp_name'];
                        $fileEx = explode('.', $fileName);
                        $fileExtension = end($fileEx);
                        $extension = ['jpg', 'png', 'jpeg', 'webp', 'avif'];

                        if (in_array($fileExtension, $extension) == true) {
                            $time = time();
                            $fileRename = $time . $fileName;

                            if (move_uploaded_file($fileTemp, "./upload/" . $fileRename)) {
                                $status = "Active Now";
                                $unique_id = rand(time(), 1000000);
                                $insertQuery = "INSERT INTO users(username, email, pass, repass, user_img, unique_id, status) VALUES ('{$username}','{$email}','{$pass}','{$repass}','{$fileRename}','{$unique_id}','{$status}')";

                                if (mysqli_query($connection, $insertQuery)) {
                                    $getEmailQuery = "SELECT * FROM users WHERE email = '{$email}'";
                                    if ($getEmailResult = mysqli_query($connection, $getEmailQuery)) {

                                        if (mysqli_num_rows($getEmailResult) > 0) {
                                            $fetchUniqueId = mysqli_fetch_assoc($getEmailResult);
                                            $_SESSION['login_id'] = $fetchUniqueId['unique_id'];
                                            echo "success";
                                        } else {
                                            echo "Your Email Found";
                                        }
                                    } else {
                                        echo "Get Email Result Query Failed";
                                    }
                                } else {
                                    echo "Data Insert Query Failed";
                                }
                            } else {
                                echo "file Upload Filed";
                            }
                        } else {
                            echo "$fileName - this file extension is not allow";
                        }
                    } else {
                        echo "Please Select Any Image";
                    }
                }
            } else {
                echo "Email Check Query Filed";
            }
        } else {
            echo "$email - Email Not Valued";
        }
    } else {
        echo "Password And RePassword Not Match";
    }
} else {
    echo "Please Input Filed FillUp Then Register";
}
