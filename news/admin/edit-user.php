<?php
include "config.php";
include "header.php";
include "navbar.php";
$id = hex2bin($_GET['id']);

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $number = mysqli_real_escape_string($connection, $_POST['number']);
  $gender = mysqli_real_escape_string($connection, $_POST['gender']);
  $role = mysqli_real_escape_string($connection, $_POST['role']);
  $date = mysqli_real_escape_string($connection, $_POST['date']);

  $updateQuery = "UPDATE users SET username='{$username}', email='{$email}', number='{$number}', gender='{$gender}', role='{$role}', date='{$date}' WHERE id='$id'";
  $updateResult = mysqli_query($connection, $updateQuery) or die("Update Query Failed");

  if ($updateResult) {
    header("location: {$mainUrl}admin/users.php");
  }
}
?>

<section class="" style="background-color: #eee;">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <?php
                $getQuery = "SELECT * FROM users WHERE id= {$id}";
                $result = mysqli_query($connection, $getQuery) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mx-1 mx-md-4">
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" name="username" id="form3Example1c" class="form-control" value="<?php echo $row['username'] ?>" />
                          <label class="form-label" for="form3Example1c">User Name</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="email" name="email" id="form3Example3c" class="form-control" value="<?php echo $row['email'] ?>" />
                          <label class="form-label" for="form3Example3c">Your Email</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input disabled type="password" name="password" id="form3Example4c" class="form-control" />
                          <label class="form-label" for="form3Example4c">Password</label>
                        </div>
                      </div>


                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="number" name="number" id="form3Example4cde" class="form-control" value="0<?php echo $row['number'] ?>" />
                          <label class="form-label" for="form3Example4cde">Phone Number</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa-solid fa-transgender fas fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <select class="form-select" name="gender" aria-label="Default select example">
                            <option <?php echo ($row['gender'] == 'male') ? "selected" : ""; ?> value="male">Male</option>
                            <option <?php echo ($row['gender'] == 'female') ? "selected" : ""; ?> value="female">Female</option>
                            <option <?php echo ($row['gender'] == 'other') ? "selected" : ""; ?> value="other">Other</option>
                          </select>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa-solid fa-hand-pointer fas fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <select class="form-select" name="role" aria-label="Default select example">
                            <option <?php echo ($row['role'] == '2') ? "selected" : ""; ?> value="2">Editor</option>
                            <option <?php echo ($row['role'] == '3') ? "selected" : ""; ?> value="3">Commentor</option>
                            <option <?php echo ($row['role'] == '4') ? "selected" : ""; ?> value="4">Viewer</option>
                          </select>
                        </div>
                      </div>

                      <?php
                      $dateTime = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
                      echo "<input hidden type='text' name='date' value='{$dateTime->format("d M Y h:i:s A")}'>";
                      ?>

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                      </div>
                    </form>

                <?php
                  }
                } else {
                  echo "<h3>User Not Found Database</h3>";
                }
                ?>
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="../main_img/draw1.webp" class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





<?php include "footer.php"; ?>