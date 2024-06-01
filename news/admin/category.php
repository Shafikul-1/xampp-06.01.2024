<?php
include "config.php";
include "header.php";
if ($_SESSION['role'] == '3' || $_SESSION['role'] == '4') {
    header("location: {$mainUrl}admin/post.php");
}
include "navbar.php";

$query = "SELECT * FROM category";
$result = mysqli_query($connection, $query) or die("Query Failed");

?>
<div class="d-flex justify-content-between mt-4 mx-3">
    <h4>Category List All</h4>
    <a href="add-category.php" class="btn btn-outline-success btn-sm ">Add Post</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <!-- <th scope="col">Author</th> -->
            <th scope="col">Category Name</th>
            <th scope="col">Post</th>
            <th scope="col">Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <th scope="row"><?php echo $row['category_id'] ?></th>
                    <!-- <td>Shfikul</td> -->
                    <td><?php echo ucwords($row['category_name']) ?></td>
                    <td><?php echo $row['post'] ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                        <!-- <a href="<?php echo $mainUrl . 'admin/delete-user.php?id=' . bin2hex($row['id']) ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </a> -->
                        <a href="<?php echo $mainUrl . 'admin/edit-category.php?id=' . $row['category_id'] ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </a>
                        <a href="<?php echo $mainUrl . 'category.php?id='.$row['category_id'] ?>" type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>

    </tbody>
</table>

<?php include "footer.php"; ?>