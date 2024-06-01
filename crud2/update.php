<?php 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $connection = mysqli_connect("localhost", "root", "", "crud2") or die("Database Connect Error");
  $query = "SELECT * FROM crud WHERE id={$id}";
  $result = mysqli_query($connection, $query); 
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="css/create.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="update_data.php" method="post" enctype="multipart/form-data">
        <?php 
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <input type="text" hidden name="id" value="<?php echo $row['id'] ?>">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name" value="<?php echo $row['name'] ?>">
          </div>
          <div class="input-box">
            <span class="details">Date</span>
            <input type="date" placeholder="Enter your username" name="date" value="<?php echo $row['date'] ?>">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" value="<?php echo $row['email'] ?>">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" placeholder="Enter your number" name="number" value="<?php echo $row['phone'] ?>">
          </div>
         
          <div class="input-box">
            <span class="details">Roll</span>
            <select name="roll" id="" style="width:100%;">
                <option value="1">Admin</option>
                <option value="2">Editor</option>
                <option value="3">User</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Image</span>
            <input type="file"  name="fileupload">
          </div>
          <img src="upload/<?php echo $row['img'] ?>" style="width:50px; hight:50px;" alt="">
        </div>
       
        <div class="button">
          <input type="submit" value="Update Data">
        </div>
        <?php 
           }
          } else {
              echo "Database Data Not Found";
          }
        } else {
          echo "No Data";
        }
        mysqli_close($connection);
        ?>
      </form>
    </div>
  </div>
</body>
</html>
