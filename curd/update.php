<?php 
    $connection = mysqli_connect("localhost", "crud_data", "y26_sNJbs[g6MFId", "crud_data") or die("Database Connection Failed");
    
    $collect_id = $_GET['id'];
    $query = "SELECT * FROM student WHERE id={$collect_id}";

    $result = mysqli_query($connection, $query) or die("Query Connection Failed");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form action="updateinsert.php" method="post" class="border border-primary m-4 p-3">
  <input type="text" hidden name="id" value="<?php echo $row['id'] ?>">
   <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Your Name" value="<?php echo $row['name'] ?>">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $row['email'] ?>"> 
  </div>
  <div class="mb-3">
    <label for="number" class="form-label">Phone Number</label>
    <input name="number" type="number" class="form-control" id="number" placeholder="0175678..." value="<?php echo $row['phone'] ?>">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input name="address" type="text" class="form-control" id="address" placeholder="Enter Your Address" value="<?php echo $row['address'] ?>">
  </div>
  <div class="mb-3">
    <label for="select" class="form-label">Select Your Class</label>
        <select class="form-select" name="class" aria-label="Default select example" id="select" style="width:100%">
        <option value="<?php echo $row['class'] ?>" selected><?php echo $row['class'] ?></option>
        <?php 
            $collect_class_table = "SELECT * FROM student";
            $collect_class = mysqli_query($connection, $collect_class_table) or die("class colllect failed");
            if (mysqli_num_rows($collect_class) > 0) {
                while ($class_row = mysqli_fetch_assoc($collect_class)) {
                    // print_r($class_row);
                    echo "<option>{$class_row['class']}</option>";
                }
            } 
            
        ?>
        
        </select> 
    <br><br><br>
  </div>

  <input type="submit" class="btn btn-success" value="Submit">
</form>

<?php 
// print_r($collect_class);
     }
    } else {
        echo "<h2>Database No Data Found</h2>";
    }

mysqli_close($connection);
?>




<script src="https://kit.fontawesome.com/ed5a9b6893.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>