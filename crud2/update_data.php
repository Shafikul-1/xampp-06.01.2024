<?php 
if(isset($_FILES['fileupload'])){
    $file_name = $_FILES['fileupload']['name'];
    $file_type = $_FILES['fileupload']['type'];
    $file_tmp_name = $_FILES['fileupload']['tmp_name'];
    $file_error = $_FILES['fileupload']['error'];
    $file_size = $_FILES['fileupload']['size'];
}

$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$number = $_POST['number'];
$email = $_POST['email'];
$roll = $_POST['roll'];


// echo $name, $date, $email, $number, $roll, $number;
    $connection = mysqli_connect("localhost", "root", "", "crud2") or die("Database Connection Failed");
   $sql = "UPDATE crud SET name='{$name}', date='{$date}', img='{$file_name}', phone='{$number}', email='{$email}',roll='{$roll}' WHERE id={$id}";

   if ( mysqli_query($connection, $sql) ) {
    move_uploaded_file($file_tmp_name, "upload/".$file_name);
   } else {
     echo "File upload failed";
   }
   

    header("Location: index.php");
?>