<?php 
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<!DOCTYPE html>     
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="cookieremove.php">remove session</a>
</body>
</html>

