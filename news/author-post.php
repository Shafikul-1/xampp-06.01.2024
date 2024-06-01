<?php
include "config.php";
include "header.php";
include "navbar.php";

$getId = $_GET['id'];
$sql = "SELECT * FROM post 
LEFT JOIN users ON author = users.id 
LEFT JOIN category ON category = category.category_id WHERE users.id = {$getId} ORDER BY post_id DESC";

$result = mysqli_query($connection, $sql) or die("Query Failed");

?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col">
        <div class="card m-2 authCard">
            <a href="<?php echo $mainUrl . 'view-post.php?id=' . $row['post_id'] ?>" class="text-decoration-none text-dark">
                <img src="upload/<?php echo $row['post_img'] ?>" class="card-img-top" alt="<?php echo $row['post_img'] ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['title'] ?>
                    </h5>
                    <p class="card-text">
                        <?php echo substr($row['description'], 0, 300) ?> ...
                    </p>
                </div>
            </a>
            <div class="card-footer d-flex justify-content-between text-center">
                <small class="text-body-secondary">Last updated <br>
                    <?php echo substr($row['post_date'], 0, 12) ?>
                </small>
                <small class="text-body-secondary">Author <br>
                    <?php echo $row['username'] ?>
                </small>
                <small class="text-body-secondary">Category <br>
                    <?php echo $row['category_name'] ?>
                </small>
            </div>
        </div>
    </div>
    <?php
        }
    }else{
        echo "<h2>This Author No Post</h2>";
    }
    ?>
</div>

<?php include "footer.php"; ?>
<style>
    .authCard:hover {
        box-shadow: inset 0px 0px 9px 2px black;
        transition: .3s;
    }
</style>