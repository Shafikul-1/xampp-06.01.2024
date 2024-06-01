<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Crud Application</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User <b>Management</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="create.php"  class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
                        <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
                    </div>
                </div>
            </div>
            <?php 
                $connection = mysqli_connect("localhost", "root", "", "crud2") or die("Database Connect Error");
                $query = "SELECT * FROM crud";
                $result = mysqli_query($connection, $query) or die("Query Failed"); 
            ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>						
                        <th>Date Created</th>
                        <th>Roll</th>
                        <th>Phone</th>
                        <th>Gendar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td>
                            <a href="#">
                                <img style="width:30px; hight:60px" src="upload/<?php echo $row['img'] ?>" class="avatar" alt="Avatar"> 
                                <?php echo $row['name'] ?>
                            </a>
                        </td>
                        <td><?php echo $row['date'] ?></td>                        
                        <td><?php echo $row['roll'] ?></td>
                        <td>0<?php echo $row['phone'] ?></td>
                        <td><?php echo $row['gendar'] ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id'] ?>" class="settings" title="Settings" data-toggle="tooltip">
                                <i class="material-icons">&#xE8B8;</i>
                            </a>
                            <a href="delete.php?id=<?php echo $row['id'] ?>" class="delete" title="Delete" data-toggle="tooltip">
                                <i class="material-icons">&#xE5C9;</i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                     }
                        } else {
                            echo "Database Data Not Found";
                        }
                    ?>
                </tbody>
            </table>
            
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>     
</body>
</html>