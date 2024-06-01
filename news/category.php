<?php
include "config.php";
include "header.php";
include "navbar.php";

$getId = $_GET['id'];
$sql = "SELECT * FROM post 
LEFT JOIN users ON author = users.id
LEFT JOIN category ON category = category.category_id 
WHERE category.category_id = {$getId}";
$result = mysqli_query($connection, $sql) or die("Query Failed");
?>

<div class="container-fluid">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php  
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col">
           <a href="<?php echo $mainUrl."view-post.php?id=".$row['post_id'] ?>">
            <div class="card  text-bg-dark">
                <img src="upload/<?php echo $row['post_img'] ?>" class="card-img overly" alt="<?php echo $row['post_img'] ?>">
                <div class="card-img-overlay">
                    <h3 class="card-title"><?php echo $row['title'] ?></h3>
                    <p class="card-text pt-3"><?php echo substr($row['description'], 0, 450) ?> ...</p>
                    <p class="card-text">
                        <small>Last updated 
                            <?php echo substr($row['post_date'], 0, 450) ?>
                        </small>
                    </p>
                </div>
            </div>
           </a>
        </div>
        <?php 
            }
        }else{
            echo "<h2>This Category No Post</h2>";
        }
        ?>
    </div>
</div>
<?php include "footer.php"; ?>
<style>
    .overly{
        opacity: 0.5;
    }
</style>