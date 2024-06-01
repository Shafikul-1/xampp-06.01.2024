<?php include "config.php"; ?>

<div class="mb40 mt-4">
    <h4 class="sidebar-title">Categories</h4>
    <ul class="list-unstyled categories">
        <?php
        $sql = "SELECT category_id, category_name FROM category";
        $result = mysqli_query($connection, $sql) or die("Query Failed");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // print_r($row);
                echo "<li class='d-flex mt-2'><a href='{$mainUrl}category.php?id=" . $row['category_id'] . "' class='btn btn-outline-secondary'>" . ucwords($row['category_name']) . "</a></li>";
            }
        }
        ?>
    </ul>
</div>
<!--/col-->
<div>
    <h4 class="sidebar-title">Latest News</h4>
    <!-- <ul class="list-unstyled"> -->
    <?php
    $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 10 ";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="<?php echo $mainUrl . 'view-post.php?id=' . $row['post_id'] ?>" class="text-decoration-none text-dark">
            <div class="card mb-3 RecentPost">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="upload/<?php echo $row['post_img']; ?>" class="img-fluid rounded-start imageSideBarSize"
                            alt="<?php echo $row['post_img']; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="card-title m-0">
                                <?php echo substr($row['title'], 0, 10) ?> ...
                            </h6>
                            <small class="card-text">
                                <?php echo substr($row['description'], 0, 15) ?> ...
                            </small><br>
                            <small class="card-text"><small class="text-body-secondary">Last updated
                                    <?php echo substr($row['post_date'], 0, 12) ?>
                                </small></small>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        
    <?php } } ?>
</div>










<style>
    body {
        margin-top: 20px;
    }

    .imageSideBarSize {
        height: 100%;
    }

    .RecentPost:hover {
        box-shadow: inset 0px 0px 9px 2px black;
        transition: .3s;
    }

    /*
Blog post entries
*/

    .entry-card {
        -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
    }

    .entry-content {
        background-color: #fff;
        padding: 36px 36px 36px 36px;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .entry-content .entry-title a {
        color: #333;
    }

    .entry-content .entry-title a:hover {
        color: #4782d3;
    }

    .entry-content .entry-meta span {
        font-size: 12px;
    }

    .entry-title {
        font-size: .95rem;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .entry-thumb {
        display: block;
        position: relative;
        overflow: hidden;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }

    .entry-thumb img {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }

    .entry-thumb .thumb-hover {
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(71, 130, 211, 0.85);
        display: block;
        top: 50%;
        left: 50%;
        color: #fff;
        font-size: 40px;
        line-height: 100px;
        border-radius: 50%;
        margin-top: -50px;
        margin-left: -50px;
        text-align: center;
        transform: scale(0);
        -webkit-transform: scale(0);
        opacity: 0;
        transition: all .3s ease-in-out;
        -webkit-transition: all .3s ease-in-out;
    }

    .entry-thumb:hover .thumb-hover {
        opacity: 1;
        transform: scale(1);
        -webkit-transform: scale(1);
    }

    .article-post {
        border-bottom: 1px solid #eee;
        padding-bottom: 70px;
    }

    .article-post .post-thumb {
        display: block;
        position: relative;
        overflow: hidden;
    }

    .article-post .post-thumb .post-overlay {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        transition: all .3s;
        -webkit-transition: all .3s;
        opacity: 0;
    }

    .article-post .post-thumb .post-overlay span {
        width: 100%;
        display: block;
        vertical-align: middle;
        text-align: center;
        transform: translateY(70%);
        -webkit-transform: translateY(70%);
        transition: all .3s;
        -webkit-transition: all .3s;
        height: 100%;
        color: #fff;
    }

    .article-post .post-thumb:hover .post-overlay {
        opacity: 1;
    }

    .article-post .post-thumb:hover .post-overlay span {
        transform: translateY(50%);
        -webkit-transform: translateY(50%);
    }

    .post-content .post-title {
        font-weight: 500;
    }

    .post-meta {
        padding-top: 15px;
        margin-bottom: 20px;
    }

    .post-meta li:not(:last-child) {
        margin-right: 10px;
    }

    .post-meta li a {
        color: #999;
        font-size: 13px;
    }

    .post-meta li a:hover {
        color: #4782d3;
    }

    .post-meta li i {
        margin-right: 5px;
    }

    .post-meta li:after {
        margin-top: -5px;
        content: "/";
        margin-left: 10px;
    }

    .post-meta li:last-child:after {
        display: none;
    }

    .post-masonry .masonry-title {
        font-weight: 500;
    }

    .share-buttons li {
        vertical-align: middle;
    }

    .share-buttons li a {
        margin-right: 0px;
    }

    .post-content .fa {
        color: #ddd;
    }

    .post-content a h2 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 0px;
    }

    .article-post .owl-carousel {
        margin-bottom: 20px !important;
    }

    .post-masonry h4 {
        text-transform: capitalize;
        font-size: 1rem;
        font-weight: 700;
    }

    .mb40 {
        margin-bottom: 40px !important;
    }

    .mb30 {
        margin-bottom: 30px !important;
    }

    .media-body h5 a {
        color: #555;
    }

    .categories li a:before {
        content: "\f0da";
        font-family: 'FontAwesome';
        margin-right: 5px;
    }

    /*
Template sidebar
*/

    .sidebar-title {
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .categories li {
        vertical-align: middle;
    }

    .categories li>ul {
        padding-left: 15px;
    }

    .categories li>ul>li>a {
        font-weight: 300;
    }

    .categories li a {
        color: #999;
        position: relative;
        display: block;
        padding: 5px 10px;
        border-bottom: 1px solid #eee;
    }

    .categories li a:before {
        content: "\f0da";
        font-family: 'FontAwesome';
        margin-right: 5px;
    }

    .categories li a:hover {
        color: #444;
        background-color: #f5f5f5;
    }

    .categories>li.active>a {
        font-weight: 600;
        color: #444;
    }

    .media-body h5 {
        font-size: 15px;
        letter-spacing: 0px;
        line-height: 20px;
        font-weight: 400;
    }

    .media-body h5 a {
        color: #555;
    }

    .media-body h5 a:hover {
        color: #4782d3;
    }
</style>