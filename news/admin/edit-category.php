<?php
include "config.php";
include "header.php";
include "navbar.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getQuery = "SELECT category_name FROM category WHERE category_id = {$id}";
    $getResult = mysqli_query($connection, $getQuery) or die("Query Failed");
?>

    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="addCategory" class="form-label">Add Category</label>
            <?php
            if (mysqli_num_rows($getResult) > 0) {
                while ($row = mysqli_fetch_assoc($getResult)) {
            ?>
                    <input type="text" name="category_name" class="form-control" id="addCategory" value="<?php echo $row['category_name'] ?>">
            <?php   }
            } ?>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>


<?php
} else {
    header("location: {$mainUrl}admin/category.php");
}

if (isset($_POST['submit'])) {
    $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $query = "UPDATE `category` SET `category_name`='{$category_name}' WHERE category_id = {$id}";
    $result = mysqli_query($connection, $query) or die("Query Failed");
    if ($result) {
        header("location: {$mainUrl}admin/category.php");
    } else {
        header("location: {$mainUrl}admin/edit-category.php?msg=failed");
    }
    if (isset($_GET['msg'])) {
        echo "Category Update Failed";
    }
}

?>