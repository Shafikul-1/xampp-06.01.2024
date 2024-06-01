<?php
include "config.php";
include "header.php";
include "navbar.php";

$sessionGetRole = $_SESSION['role'] ;
// echo $sessionGetRole;
if(!($sessionGetRole == 1)){
  header("location: {$mainUrl}admin/post.php");
}

if (isset($_POST['submit'])) {
    $title  = mysqli_real_escape_string($connection, $_POST['title']);
    $fav_icon  = mysqli_real_escape_string($connection, $_POST['fav_icon']);
    $logo  = mysqli_real_escape_string($connection, $_POST['logo']);
    $footer_des  = mysqli_real_escape_string($connection, $_POST['footer_des']);

    $settingUpdateQuery = "UPDATE setting SET title='{$title}', fav_icon='{$fav_icon}', logo='{$logo}', footer_des='{$footer_des}'";
    $settingUpdateResult = mysqli_query($connection, $settingUpdateQuery) or die("Setting Update Failed");
    if ($settingUpdateResult) {
        header("location: http://localhost/news/admin/post.php");
    } else {
        echo "Query Filed";
    }
}
?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mx-4 my-3 border border-2 border-success-subtle rounded py-3 px-3">
    <?php
    $query = "SELECT * FROM setting";
    $result = mysqli_query($connection, $query) or die("Setting Query Failed");
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="mb-3">
        <label for="title" class="form-label">Website Title</label>
        <input type="text" name="title" class="form-control" id="title" value="<?php echo $row['title'] ?>" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="favIconLink" class="form-label">Website Favicon Link</label>
        <input type="text" name="fav_icon" class="form-control" value="<?php echo $row['fav_icon'] ?>" id="favIconLink" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="logoLink" class="form-label">Website Logo Link</label>
        <input type="text" name="logo" class="form-control" value="<?php echo $row['logo'] ?>" id="logoLink" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Footer Description</label>
        <textarea class="form-control" name="footer_des" id="exampleFormControlTextarea1" rows="3">
            <?php echo $row['footer_des'] ?>
        </textarea>
    </div>
    <?php
        }
    }
    ?>
    <button type="submit" name="submit" class="btn btn-success">Submit Information</button>
</form>

<?php
include "footer.php";
?>