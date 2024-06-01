<?php 
    $connection = mysqli_connect("localhost", "crud_data", "y26_sNJbs[g6MFId", "crud_data") or die("Connection Failed");
    $quary = "SELECT * FROM student";

    $result = mysqli_query($connection, $quary) or die("Query Faild");
   
    if(mysqli_num_rows($result) > 0){
?>
<pre>

</pre>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD APPLICATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  
  <h2 class="bg-success bg-gradient text-center">CRUD APPLICATION</h2>
<a href="create.php" class="bg-success text-white btn my-3">Create Data</a>

<table class="table table-dark table-striped">
  <thead>
    <tr class="text-center">
      <th scope="col" class="text-dark bg-success">#</th>
      <th scope="col" class="text-dark bg-danger">Name</th>
      <th scope="col" class="text-dark bg-warning">Email</th>
      <th scope="col" class="text-white bg-secondary">Address</th>
      <th scope="col" class="text-dark bg-warning">Phone</th>
      <th scope="col" class="text-dark bg-success-subtle">Class</th>
      <th scope="col" class="text-dark bg-primary">Handle</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['class']; ?></td>
      <td>
        <div class="d-flex justify-content-evenly">
          <a href="view.php"><i class="fa-solid fa-eye" style="color: white;"></i></a>
          <a href="update.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-wrench" ></i></a>
          <a href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
        </div>
      </td>
    </tr>
   
  </tbody>
  <?php 
     }
  ?>
</table>
<?php 
    }else{
        echo "<h2>Database no Data</h2>";
    }
    mysqli_close($connection);
?>






<script src="https://kit.fontawesome.com/ed5a9b6893.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>