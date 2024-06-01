<?php
include "config.php";
include "header.php";
include "navbar.php";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$limit = 3;
$offset = ($page - 1) * $limit;

$joinQuery = "SELECT * FROM post 
LEFT JOIN category ON post.category = category.category_id 
LEFT JOIN users ON post.author = users.id ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
$joinResult = mysqli_query($connection, $joinQuery) or die("Join Query Failed");


if(isset($_GET['msg']) == 'dfld'){
    echo "<h3 style='color: red;'>Post Delete Failed</h3>";
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                    <a href="add-post.php" class="btn btn-outline-success btn-sm addUserBtnSm">Add Post</a>
                </div>
                <div class="table-responsive">
                    <table class="table no-wrap user-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">image</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Title</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Description</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Publish Date</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Author</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($joinResult) > 0) {
                            while ($row = mysqli_fetch_assoc($joinResult)) {
                        ?>
                        <tr>
                        <td class="pl-4"><?php echo $row['post_id'] ?></td>
                        <td>
                            <img style="width: 100px; height:100px;" src="../upload/<?php echo $row['post_img'] ?>" alt="<?php echo $row['post_img'] ?>">
                        </td>
                        <td>
                            <span class="text-muted"><?php echo substr($row['title'], 0, 60) ?>...</span><br>
                        </td>
                        <td>
                            <span class='text-muted'><?php echo ucwords($row['category_name']) ?></span><br>
                        </td>
                        <td>
                            <span class="text-muted"><?php echo substr($row['description'], 0, 100) ?>...</span><br>
                        </td>
                        <td>
                            <span class="text-muted"><?php echo substr($row['post_date'], 0, 11) ?></span><br>
                            <span class="text-muted"><?php echo substr($row['post_date'], 12, 11) ?></span>
                        </td>
                        <td>
                            <span class="text-muted"><?php echo $row['username'] ?></span><br>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                            <a href="<?php echo $mainUrl . 'admin/delete-post.php?pid=' . bin2hex($row['post_id']).'&cid='. bin2hex($row['category_id'])?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </a>
                            <a href="<?php echo $mainUrl . 'admin/edit-post.php?id=' . bin2hex($row['post_id']) ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </a>
                            <a href="<?php echo $mainUrl . 'view-post.php?id=' . $row['post_id'] ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </a>
                        </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<h5 style='margin:1rem 0'>Database Data Not Found</h5>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <!-- Pagination -->
                        <?php
                        $paginationSql = "SELECT * FROM post";
                        $paginationQuery = mysqli_query($connection, $paginationSql) or die("Pagination Query Failed");
                        if (mysqli_num_rows($paginationQuery) > 0) {
                            $totalRecord = mysqli_num_rows($paginationQuery);
                            $totalPage = ceil($totalRecord / $limit);

                            if ($page > 1) {
                                echo "<a href='{$mainUrl}admin/post.php?page=" . ($page - 1) . "' type='button' class='btn btn-outline-success my-2 mx-1'>Prev</a>";
                            }
                            for ($i = 1; $i < $totalPage; $i++) {
                                if ($i == $page) {
                                    $activePage = 'active';
                                } else {
                                    $activePage = '';
                                }
                                echo "<a href='{$mainUrl}admin/post.php?page=$i' type='button' class='btn {$activePage} btn-outline-success my-2 mx-1'>{$i}</a>";
                            }
                            if ($totalPage > $page) {
                                echo "<a href='{$mainUrl}admin/post.php?page=" . ($page + 1) . "' type='button' class='btn btn-outline-success my-2 mx-1'>Next</a>";
                            }
                        } else {
                            echo "<h5>Database Record Not Found</h5>";
                        }
                        ?>
                        <!-- Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>




<!-- Style Current Page -->
<style>
    body {
        background: #edf1f5;
        margin-top: 20px;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: 0;
    }

    .btn-circle.btn-lg,
    .btn-group-lg>.btn-circle.btn {
        width: 50px;
        height: 50px;
        padding: 14px 15px;
        font-size: 18px;
        line-height: 23px;
    }

    .text-muted {
        color: #8898aa !important;
    }

    [type=button]:not(:disabled),
    [type=reset]:not(:disabled),
    [type=submit]:not(:disabled),
    button:not(:disabled) {
        cursor: pointer;
    }

    .btn-circle {
        border-radius: 100%;
        width: 40px;
        height: 40px;
        padding: 10px;
    }

    .user-table tbody tr .category-select {
        max-width: 150px;
        border-radius: 20px;
    }
</style>