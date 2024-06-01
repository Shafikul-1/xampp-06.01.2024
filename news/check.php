<?php
include "config.php";
include "header.php";
include "navbar.php";

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['role'] . "<br>";
// echo $_SESSION['password'] . "<br>";
// echo $_SESSION['id'] . "<br>";

if(isset($_POST['submit'])){
    if(isset($_POST['description'])){
        print_r($_POST['description']);
    }
}

echo md5("admin@");
?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<div contenteditable="true" name="description" class="contentAbleDiv"></div>
<input type="submit" name="submit" value="Submit">
</form>


<?php include "footer.php"; ?>
<style>
    .contentAbleDiv {
        border: 4px solid blue;
        max-height: 300px;
        overflow: scroll;
    }
</style>