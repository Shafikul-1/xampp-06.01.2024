 <?php 
  $connection = mysqli_connect("localhost", "crud_data", "y26_sNJbs[g6MFId", "crud_data") or die ("Database Connect Faild");
  $queary = "SELECT * FROM 	student";

  $result = mysqli_query($connection, $queary) or die("Sql Queary Faild");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<form action="insertdata.php" method="post" class="border border-primary m-4 p-3">
   <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Your Name">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
  </div>
  <div class="mb-3">
    <label for="number" class="form-label">Phone Number</label>
    <input name="number" type="number" class="form-control" id="number" placeholder="0175678...">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input name="address" type="text" class="form-control" id="address" placeholder="Enter Your Address">
  </div>
  <div class="mb-3">
    <label for="select" class="form-label">Select Your Class</label>
    <select class="form-select" name="class" aria-label="Default select example" id="select" style="width:100%">
      <option selected disabled>Select Your Class</option>
      <?php 
        if (mysqli_num_rows($result) > 0) {  
        while ($row = mysqli_fetch_assoc($result)) {

      ?>
      <option value="<?php echo $row['class'] ?>"><?php echo $row['class'] ?></option>
      <?php 
        }
      ?>
    </select> <br><br><br>
  </div>

  <input type="submit" class="btn btn-success" value="Submit">
</form>












 <?php 
   } else {
     echo "<h2>Query Result Faild</h2>";
   }
  mysqli_close($connection);
?> 
</body>
</html>