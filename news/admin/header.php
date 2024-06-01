<?php
include "config.php";

session_start();
if (!isset($_SESSION["username"])) {
  header("location: {$mainUrl}admin/");
}

$url = $_SERVER['REQUEST_URI']; 
$mainName= explode('/', $url)[2];
$separate = explode('.', explode('/',$url)[3])[0];

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>News | <?php echo ucwords($mainName) ." | ".ucwords( $separate) ?> | </title>
  <?php 
  $settingQuery = "SELECT fav_icon FROM setting";
  $settingResult = mysqli_query($connection, $settingQuery) or die("Setting Query Failed");
  if(mysqli_num_rows($settingResult) > 0){
    while($settingRow = mysqli_fetch_assoc($settingResult)){
      echo "<link rel='shortcut icon' href=".$settingRow['fav_icon']." type='image/x-icon'>";
    }
  }
  ?>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
