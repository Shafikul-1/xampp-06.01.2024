<?php
include "config.php";
include "header.php";
include "navbar.php";

if (isset($_POST['submit'])) {
    $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $post = mysqli_real_escape_string($connection, $_POST['post']);
    $query = "INSERT INTO category (`category_name`, `post`) VALUES ('{$category_name}', '{$post}')";
    $result = mysqli_query($connection, $query) or die("Query Failed");
    if ($result) {
        header("location: {$mainUrl}admin/category.php");
    } else {
        header("location: {$mainUrl}admin/add-category.php?msg=failed");
    }
}

if (isset($_GET['msg'])) {
    echo "Category Insert Failed";
}

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mb-3">
        <label for="addCategory" class="form-label">Add Category</label>
        <input type="text" name="category_name" class="form-control" id="addCategory">
        <input type="hidden" value="0" name="post" id="">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>


<?php


?>