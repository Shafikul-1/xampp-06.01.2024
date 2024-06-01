<?php
include "config.php";
include "header.php";
include "navbar.php";
if(isset($_GET['search'])){
    $search =  mysqli_real_escape_string( $connection, $_GET['search']);
}


$limit = 2;
if(isset($_GET['page'])){
    $page = $_GET['page'];
} else{
    $page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM post 
LEFT JOIN users ON author = users.id 
LEFT JOIN category ON category = category.category_id WHERE title LIKE '%{$search}%'
ORDER BY post_id DESC LIMIT {$offset}, {$limit} ";

$result = mysqli_query($connection, $sql) or die("Query Failed");

?>


<link rel="stylesheet" href="css/home.css">
<div class="container-fluid pb50">
    <div class="row">
        <div class="col-md-10 mb40">
<article>
    <div class="post-content">
        <div class="container-fluid">
            <div class="row ">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-6">
                    <div class="media blog-media">
                        <a href="<?php echo " {$mainUrl}view-post.php?id=" . $row['post_id'] ?>">
                            <img class="d-flex imageSize" src="upload/<?php echo $row['post_img']; ?>"
                                alt="<?php echo $row['post_img']; ?>">
                        </a>
                        <div class="circle">
                            <h5 class="day">
                                <?php echo substr($row['post_date'], 0, 2) ?>
                            </h5>
                            <span class="month">
                                <?php echo substr($row['post_date'], 2, 5) ?>
                            </span>
                        </div>
                        <div class="media-body">
                            <a href="<?php echo " {$mainUrl}view-post.php?id=" . $row['post_id'] ?>" class="text-decoration-none text-dark">
                                <h5 class="mt-0  fw-bold">
                                    <?php echo substr($row['title'], 0, 20) ?> ...
                                </h5>
                            </a>
                            <p style="margin: 0;">
                                <?php echo substr($row['description'], 0, 170)  ?> ...
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo " {$mainUrl}view-post.php?id=" . $row['post_id'] ?>" class="post-link">Read More</a>
                                <small class="PostDate">
                                    <?php echo substr($row['post_date'], 12, 22) ?>
                                </small>
                            </div>
                            <ul style="margin: 0;">
                                <li>By: 
                                    <a href="<?php echo $mainUrl.'author-post.php?id='.$row['author'] ?>"><?php echo ucwords($row['username']); ?></a>
                                </li>
                                <li class="text-right">
                                    <a href="#">07 comments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else{
                    echo "<h2>Your Search Result No Record Found</h2>";
                }
                ?>
            </div>
        </div>
        <nav class="pagination" aria-label="...">
            <ul class="pagination">
                <?php 
                $paginationQuery = "SELECT * FROM post WHERE title LIKE '%{$search}%' ";
                // SELECT * FROM post WHERE title LIKE '%sneaker%' ORDER BY post_id DESC LIMIT 0, 3;
                $paginationResult = mysqli_query($connection, $paginationQuery) or die("Pagination Query Failed");
                if(mysqli_num_rows($paginationResult) > 0){
                    $totalRecord = mysqli_num_rows($paginationResult);
                    $totalPage = ceil($totalRecord / $limit); 
                ?>
                <li class="page-item <?php echo ($page > 1) ? "" : "disabled"; ?>">
                    <a href="<?php echo $mainUrl.'search.php?search='. $search.'&page='.$page - 1 ?>" class="page-link">Previous</a>
                </li>

                <?php  for ($i=1; $i < $totalPage; $i++) {  ?>

                <li class="page-item">
                    <a class="page-link <?php echo  ($i == $page) ? "active" : ""; ?>" href="<?php echo $mainUrl.'search.php?search='. $search.'&page='.$i; ?>"><?php echo $i; ?></a>
                </li>  

                <?php  }  } ?>

                 <li class="page-item">
                    <a class="page-link <?php echo ($totalPage > $page) ? "" : "disabled"; ?>" href="<?php echo $mainUrl.'search.php?search='. $search.'&page='.$page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</article> 
        </div>
        <div class="col-md-2 mb40">
            <?php include "sidebar.php"; ?>
        </div>
    </div>
</div>




<?php include "footer.php"; ?>