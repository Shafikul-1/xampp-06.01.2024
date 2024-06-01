<?php 
$name = $_POST['name'];
$date = $_POST['date'];
$number = $_POST['number'];
$email = $_POST['email'];
$roll = $_POST['roll'];

if(isset($_FILES['fileToUpload'])){
    $file_name = $_FILES['fileToUpload']['name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $file_error = $_FILES['fileToUpload']['error'];
    $file_size = $_FILES['fileToUpload']['size'];
}
// echo $name, $date, $email, $number, $roll, $gender,  $upload_file;

$connection = mysqli_connect("localhost", "root", "", "crud2") or die("Database Connection Failed");
$query = "INSERT INTO crud (name, date, phone, email, roll, img) VALUES ('{$name}', '{$date}', '{$number}','{$email}','{$roll}', '{$file_name}')";

if (!mysqli_query($connection, $query)) {
    echo "Query UnSuccessful";
} else {
    move_uploaded_file($file_tmp_name, "upload/".$file_name);
    
}

header("Location: index.php");
mysqli_close($connection);
?>				
