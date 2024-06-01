<?php
include "config.php";

$limit =5;
if(isset($_GET['page'])){
    $page = $_GET['page'];
} else{
    $page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM post 
LEFT JOIN users ON author = users.id 
LEFT JOIN category ON category = category.category_id ORDER BY post_id DESC LIMIT {$offset}, {$limit} ";

$result = mysqli_query($connection, $sql) or die("Query Failed");

?>
<link rel="stylesheet" href="css/home.css">
<article>
    <div class="post-content">
        <div class="container-fluid">
            <div class="row ">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card mb-3 titleDesign">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <a href="<?php echo " {$mainUrl}view-post.php?id=" . $row['post_id'] ?>">
                            <img class="img-fluid rounded-start postImg" src="upload/<?php echo $row['post_img']; ?>"
                                alt="<?php echo $row['post_img']; ?>">
                        </a>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                             <a href="<?php echo " {$mainUrl}view-post.php?id=" . $row['post_id'] ?>" class="card-title text-decoration-none">
                                <h5 class="mt-0 fw-bold">
                                    <?php echo substr($row['title'], 0, 50) ?> ...
                                </h5>
                            </a>
                            <p style="margin: 0;" class="card-text"> <?php echo substr($row['description'], 0, 250)  ?> 
                                <a href="<?php echo " {$mainUrl}view-post.php?id=".$row['post_id'] ?>" class="readMoreBtn">Read More ...</a>
                            </p>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="card-text">
                                    <small class="text-body-secondary">Last updated 
                                        <code class="dateDesign"> <?php echo substr($row['post_date'], 0, 11) ?> </code>
                                    </small>
                                </p> 
                                <p class="card-text">
                                    <small class="text-body-secondary">Category:  
                                        <a class="categoryDesign" href="<?php echo $mainUrl.'category.php?id='.$row['category_id'] ?>">
                                            <code> <?php echo ucwords($row['category_name']) ?> </code>
                                        </a> 
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-body-secondary">Writing By: 
                                        <a class="authorDesign" href="<?php echo $mainUrl.'author-post.php?id='.$row['author'] ?>"> 
                                            <?php echo ucwords($row['username']); ?>
                                        </a>
                                    </small>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else{
                    echo "<h2>Database Data Not Found</h2>";
                }
                ?>
            </div>
        </div>
        <nav class="pagination" aria-label="...">
            <ul class="pagination">
                <?php 
                $paginationQuery = "SELECT * FROM post";
                $paginationResult = mysqli_query($connection, $paginationQuery) or die("Pagination Query Failed");
                if(mysqli_num_rows($paginationResult) > 0){
                    $totalRecord = mysqli_num_rows($paginationResult);
                    $totalPage = ceil($totalRecord / $limit); 
                ?>
                <li class="page-item <?php echo ($page > 1) ? "" : "disabled"; ?>">
                    <a href="<?php echo $mainUrl.'?page='.$page - 1; ?>" class="page-link">Previous</a>
                </li>

                <?php  for ($i=1; $i < $totalPage; $i++) {  ?>

                <li class="page-item">
                    <a class="page-link <?php echo  ($i == $page) ? "active" : ""; ?>" href="<?php echo $mainUrl.'?page='.$i; ?>"><?php echo $i; ?></a>
                </li>  

                <?php  }  } ?>

                 <li class="page-item">
                    <a class="page-link <?php echo ($totalPage > $page) ? "" : "disabled"; ?>" href="<?php echo $mainUrl.'?page='.$page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</article> 

<style>
    .readMoreBtn{
        text-decoration: none;
        font-style: oblique;
        font-size: smaller;
        font-weight: 900;
    }
    .readMoreBtn:hover{
        text-decoration: underline;
        color: green;
    }
    .categoryDesign{
        color: green;
        text-decoration: none;
        font-weight: 900;
    }
    .categoryDesign:hover{
        text-decoration: underline;
        color: red;
    }
    .dateDesign{
        font-weight: 900;
    }
    .authorDesign{
        font-weight: 900;
        font-size: smaller;
    }
    .authorDesign:hover{
        text-decoration: none;
        color: red;
    }
    .titleDesign h5{
        color: black;
    }
    .titleDesign:hover h5{
        color: green;
    }
    .postImg{
        height: 100% !important;
    }
</style>