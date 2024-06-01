<?php
include "header.php";
include "config.php";
$email = mysqli_real_escape_string($connection, $_POST['email']);
$pass = md5(mysqli_real_escape_string($connection, $_POST['pass']));


// echo "Login page<br>";
// echo $email."<br>";
// echo $pass."<br>";
if (!empty($email) && !empty($pass)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $fetchResult = mysqli_fetch_assoc($result);
            if ($fetchResult['email'] == $email && $fetchResult['pass'] == $pass) {
                $_SESSION['login_id'] = $fetchResult['unique_id'];
                echo "success";
            } else {
                echo "Your Information Not Match";
            }
        } else {
            echo "Your Information Wrong";
        }
    } else {
        echo "$email - Email Not Valued";
    }
} else {
    echo "Please Fill up Your Info";
}
