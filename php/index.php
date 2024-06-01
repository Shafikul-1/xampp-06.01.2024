<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include "config.php";

    $query = "SELECT * FROM users";

    $result = mysqli_query($conn, $query) or die("query failed");
    $check = mysqli_fetch_all($result);
    ?>

    <pre>
        <?php print_r($check) ?>
    </pre>
</body>
</html>