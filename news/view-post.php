<?php 
include "config.php";
include "header.php";
include "navbar.php";
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id='.$_GET['id'];

if(isset($_POST['submit'])){
    $feedback_user_name = mysqli_real_escape_string($connection, $_POST['username']);
    $feedback_user_email = mysqli_real_escape_string($connection, $_POST['email']);
    $feedback_user_comment = mysqli_real_escape_string($connection, $_POST['comment']);
    if(isset($_GET['id'])){
        $post_id = mysqli_real_escape_string($connection, $_GET['id']);
    }

    $query = "INSERT INTO feedback(feedback_user_name, feedback_user_email, feedback_user_comment, post_id) VALUES ('{$feedback_user_name}', '{$feedback_user_email}', '{$feedback_user_comment}', {$post_id})";

    $result = mysqli_query($connection, $query) or die("Query Failed");
    if($result){
        header("location: {$actual_link}");
        echo "Feedback Submitted";
    }
}




if (!$_GET['id']) {
    header("location: $mainUrl");
} else {
    $postId = $_GET['id'];
    // $query = "SELECT * FROM post WHERE post_id = {$postId}";
    $query = "SELECT * FROM post LEFT JOIN users ON author = users.id LEFT JOIN category ON category = category.category_id WHERE post_id = {$postId}";
    $result = mysqli_query($connection,$query) or die("Query Failed");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($postId == $row['post_id']){
?>

<link rel="stylesheet" href="./css/postview.css">
<div class="container pb50">
    <div class="row">
        <div class="col-md-9 mb40">
            <article>
                <img src="upload/<?php echo $row['post_img'] ?>" alt="" class="img-fluid mb30">
                <div class="post-content">
                    <h3><?php echo ucwords($row['title']) ?></h3>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-user-circle-o"></i> 
                            <a href="<?php echo $mainUrl.'author-post.php?id='.$row['author'] ?>">
                                <?php echo ucwords($row['username']) ?>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o"></i> <a href="#"><?php echo substr($row['post_date'], 0, 11) ?></a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-tags"></i> 
                            <a href="<?php echo $mainUrl."category.php?id=".$row['category']; ?>">
                                <?php echo ucwords($row['category_name']) ?>
                            </a>
                        </li>
                    </ul>
                    <p><?php echo $row['description'] ?></p>
                    <ul class="list-inline share-buttons">
                        <li class="list-inline-item">Share Post:</li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-facebook si-gray-round">
                                <i class="fa fa-facebook"></i>
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-twitter si-gray-round">
                                <i class="fa fa-twitter"></i>
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-icon-sm si-dark si-colored-linkedin si-gray-round">
                                <i class="fa fa-linkedin"></i>
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                    <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">About Author</h4>
                    <div class="media mb40">
                        <i class="d-flex mr-3 fa fa-user-circle fa-5x text-primary"></i>
                        <div class="media-body">
                            <h5 class="mt-0 font700">Jane Doe</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>


                    <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">Comments</h4>

                    <?php 
                    $feedbackQuery = "SELECT feedback.feedback_user_name, feedback.feedback_user_comment FROM post LEFT JOIN feedback ON post.post_id = feedback.post_id WHERE post.post_id = {$_GET['id']} ORDER BY feedback_user_id DESC";
                    $feedbackResult = mysqli_query($connection, $feedbackQuery) or die("FeedBack Query Failed");
                    if (mysqli_num_rows($feedbackResult) > 0) {
                        while($feedbackRow = mysqli_fetch_assoc($feedbackResult)){
                     ?>
                    <div class="media mb40">
                        <i class="d-flex mr-3 fa fa-user-circle-o fa-3x"></i>
                        <div class="media-body">
                            <h5 class="mt-0 font400 clearfix">
                                <a href="#" class="float-right">Reply</a>
                                <?php echo $feedbackRow['feedback_user_name'] ?>
                            </h5> 
                            <P><?php echo $feedbackRow['feedback_user_comment'] ?></P>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        echo "<h3>No Comment Any User</h3>";
                    }
                    ?>

                    <hr class="mb40">
                    <h4 class="mb40 text-uppercase font500">Post a comment</h4>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" role="user">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">User Name</label>
                            <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <input type="submit" name="submit" value="Submit Your Feed Back" class="btn btn-outline-success fw-bold">
                    </form>
                </div>
            </article>
            <!-- post article-->
            <?php 
                 }
                }
              }
            }
            ?>
        </div>
        <div class="col-md-3 mb40">
            <?php include "sidebar.php"; ?>
        </div>
    </div>
</div>




<?php include "footer.php"; ?>