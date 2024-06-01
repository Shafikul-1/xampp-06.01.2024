<?php 
include "header.php";
include "config.php";
include "navbar.php";

if(($_SESSION['role'] == '3') || ($_SESSION['role'] == '4')){
    header("location: {$mainUrl}admin/post.php");
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$limit = 3;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users ORDER BY date DESC LIMIT {$offset}, {$limit}";
$result = mysqli_query($connection, $sql) or die("Query Failed");


if (isset($_GET['msg'])) {
    echo "<h4>Delete User Failed</h4>";
} 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                    <a href="add-user.php" class="btn btn-outline-success btn-sm addUserBtnSm">Add User</a>
                </div>
                <div class="table-responsive">
                    <table class="table no-wrap user-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Occupation</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Added</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Role</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td class="pl-4"><?php echo $row['id'] ?></td>
                                <td>
                                    <h5 class="font-medium mb-0"><?php echo $row['username'] ?></h5>
                                    <span class="text-muted"><?php echo $row['gender'] ?></span>
                                </td>
                                <td>
                                    <span class="text-muted">Visual Designer</span><br>
                                    <span class="text-muted">Past : teacher</span>
                                </td>
                                <td>
                                    <span class="text-muted"><?php echo $row['email'] ?></span><br>
                                    <span class="text-muted">0<?php echo $row['number'] ?></span>
                                </td>
                                <td>
                                    <span class="text-muted"><?php echo substr($row['date'], 0, 11) ?></span><br>
                                    <span class="text-muted"><?php echo substr($row['date'], 12, 11) ?></span>
                                </td>
                                <td>
                                    <select class="form-control category-select" id="exampleFormControlSelect1">
                                        <?php 
                                            if($row['role'] == 2){
                                                echo "<option selected>Editor</option>";
                                            } else if ($row['role'] == 3) {
                                                echo "<option selected>Commentor</option>";
                                            } else if ($row['role'] == 4) {
                                                echo "<option selected>Viewer</option>";
                                            } else if ($row['role'] == 1) {
                                                echo "<option selected>Admin</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                                    <a href="<?php echo $mainUrl .'admin/delete-user.php?id='. bin2hex($row['id']) ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </a>
                                    <a href="<?php echo $mainUrl .'admin/edit-user.php?id='. bin2hex($row['id']) ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </a>
                                    <a href="<?php echo $mainUrl .'admin/user-details.php?id='. bin2hex($row['id']) ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </a>
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
                    $paginationSql = "SELECT * FROM users";
                    $paginationQuery = mysqli_query($connection, $paginationSql) or die("Pagination Query Failed");
                    if (mysqli_num_rows($paginationQuery) > 0) {
                        $totalRecord = mysqli_num_rows($paginationQuery); 
                        $totalPage = ceil($totalRecord / $limit);

                        if($page > 1){
                            echo "<a href='{$mainUrl}admin/users.php?page=".($page - 1)."' type='button' class='btn btn-outline-success my-2 mx-1'>Prev</a>";
                        }
                        for ($i=1; $i < $totalPage; $i++) { 
                            if ($i == $page) {
                                $activePage = 'active';
                            } else {
                                $activePage = '';
                            }
                            echo "<a href='{$mainUrl}admin/users.php?page=$i' type='button' class='btn {$activePage} btn-outline-success my-2 mx-1'>{$i}</a>";
                        }
                        if($totalPage > $page){
                            echo "<a href='{$mainUrl}admin/users.php?page=".($page + 1)."' type='button' class='btn btn-outline-success my-2 mx-1'>Next</a>";
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
    body{
    background: #edf1f5;
    margin-top:20px;
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
.btn-circle.btn-lg, .btn-group-lg>.btn-circle.btn {
    width: 50px;
    height: 50px;
    padding: 14px 15px;
    font-size: 18px;
    line-height: 23px;
}
.text-muted {
    color: #8898aa!important;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
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