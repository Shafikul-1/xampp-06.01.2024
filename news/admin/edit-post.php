<?php
include "config.php";
include "header.php";
include "navbar.php";

$id = hex2bin($_GET['id']);
$query = "SELECT * FROM post 
LEFT JOIN category ON post.category = category.category_id 
LEFT JOIN users ON post.author = users.id WHERE post_id = {$id} ";
// $query = "SELECT * FROM post WHERE post_id = {$id}";

$result = mysqli_query($connection, $query) or die("Query Failed");

?>
<h1>Post Edit Page</h1>
<?php 
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>
<form class="mx-5 my-4 bg-secondary-subtle px-3 py-4" action="update-post.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" hidden value="<?php echo $id; ?>">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="title" id="floatingInput" value="<?php echo $row['title'] ?>" placeholder="name@example.com">
        <label for="floatingInput">Title</label>
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Category</label>
        <select class="form-select" name="category" id="inputGroupSelect01">
            <?php 
            $categoryQuery = "SELECT category_id, category_name FROM category";
            $categoryResult = mysqli_query($connection, $categoryQuery) or die("Query Failed Category");
            if(mysqli_num_rows($categoryResult) > 0){
                while($categoryRow = mysqli_fetch_assoc($categoryResult)){
                    if ($row['category_name'] == $categoryRow['category_name']) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    echo "<option {$selected} value='{$categoryRow['category_id']}'>".ucwords($categoryRow['category_name'])."</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" hidden value="<?php echo $row['category_id'] ?>" name="oldCategory">
    </div>
    <div class="form-floating mt-3">
        <textarea class="form-control"  name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
            <?php echo $row['description'] ?>
        </textarea>
        <label for="floatingTextarea2">Comments</label>
    </div>
    <div class="input-group mb-3 mt-3">
        <label class="input-group-text" for="inputGroupFile01">Upload</label>
        <input type="file" class="form-control" name="files" id="inputGroupFile01">
    </div>
    
    <input type="hidden" name="oldFiles" value="<?php echo $row['post_img'] ?>" > 
    <img src="../upload/<?php echo $row['post_img'] ?>" style="width: 100px; height: 100px;" alt="<?php echo $row['post_img'] ?>"><br>
    <?php
    $dateTime = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    echo "<input hidden type='text' name='date' value='{$dateTime->format("d M Y h:i:s A")}'>";
    ?>
    <input type="submit" value="Submit" name="submit" class="btn btn-outline-success mt-4 submitBtn">
</form>

<?php 
    }
}
?>

<style>
    .submitBtn {
        padding: 0.5rem 3rem;
        font-weight: 700;
        font-size: 20px;
    }
</style>