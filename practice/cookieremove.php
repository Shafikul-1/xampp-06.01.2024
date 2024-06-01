<?php 
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if(!isset($_SESSION['Shafikul'])){
            echo "session nai";

        }
        else{
            echo $_SESSION['Shafikul'];
        }
    ?>
    <a href="index.php">home</a>
</body>
</html>