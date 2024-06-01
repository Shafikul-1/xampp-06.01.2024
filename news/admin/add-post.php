<?php
include "config.php";
include "header.php";
include "navbar.php";
if (isset($_GET['msg']) == 'ctn') {
   echo "<h3 style='color: red;'>Please Select Category</h3>";
}
?>

<form class="mx-5 my-4 bg-secondary-subtle px-3 py-4" action="insert-post.php" method="post" enctype="multipart/form-data">
   <div class="form-floating mb-3">
      <input type="text" class="form-control" name="title" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Title</label>
   </div>
   <?php
   $query = "SELECT * FROM category";
   $result = mysqli_query($connection, $query) or die("Category Query Failed");
   if (mysqli_num_rows($result) > 0) {
   ?>
      <div class="input-group mb-3">
         <label class="input-group-text" for="inputGroupSelect01">Category</label>
         <select class="form-select" name="category" id="inputGroupSelect01">
            <option disabled selected>Choose...</option>
            <?php while ($row = mysqli_fetch_assoc($result)) {
               echo "<option value='{$row['category_id']}'>" . ucwords($row['category_name']) . "</option>";
            } ?>
         </select>
      </div>
   <?php
   } else {
      echo "Database No Category Found";
   }
   ?>
   <div class="form-floating mt-3">
      <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
      <label for="floatingTextarea2">Comments</label>
   </div>
   <div class="input-group mb-3 mt-3">
      <label class="input-group-text" for="inputGroupFile01">Upload</label>
      <input type="file" class="form-control" name="files" id="inputGroupFile01">
   </div>
   <?php
   $dateTime = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
   echo "<input hidden type='text' name='date' value='{$dateTime->format("d M Y h:i:s A")}'>";
   ?>
   <input type="submit" value="Submit" name="submit" class="btn btn-outline-success mt-4 submitBtn">
</form>



<style>
   .submitBtn {
      padding: 0.5rem 3rem;
      font-weight: 700;
      font-size: 20px;
   }
</style>