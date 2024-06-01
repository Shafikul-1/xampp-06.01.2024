<?php
include "config.php";
include "header.php";
include "navbar.php";
// Admin Security /..
if(($_SESSION['role'] == '3') || ($_SESSION['role'] == '4')){
  header("location: {$mainUrl}admin/post.php");
}

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, md5($_POST['password']));
  $number = mysqli_real_escape_string($connection, $_POST['number']);
  $gender = (isset($_POST['gender'])) ? mysqli_real_escape_string($connection, $_POST['gender']) : header("location: {$mainUrl}admin/add-user.php?msg=gnull");;
  $role = (isset($_POST['role'])) ? mysqli_real_escape_string($connection, $_POST['role']) : header("location: {$mainUrl}admin/add-user.php?msg=rnull");;
  $date = mysqli_real_escape_string($connection, $_POST['date']);

  // Email Check Database
  $check_query = "SELECT * FROM users WHERE email = '{$email}'";
  $check_result = mysqli_query($connection, $check_query) or die("Check Query Failed");

  if (mysqli_num_rows($check_result) > 0) {
    echo "<h2 style='color:red; '>Email Already Exits</h2>";
  } else {

    // Insert Database User Value
    $query = "INSERT INTO users (username, email, password, number, gender, role, date)
    VALUES ('{$username}','{$email}','{$password}',{$number},'{$gender}',{$role}, '{$date}')";

    $result = mysqli_query($connection, $query) or die("Query Failed");
    if ($result) {
      header("location: {$mainUrl}admin/users.php");
    }
  }
}

//Error Massage Get
if (isset($_GET['msg']) == 'rnull') {
  echo "<h3 style='color:red;'>Please Select Your Role</h3>";
} else if (isset($_GET['msg']) == 'gnull') {
  echo "<h3 style='color:red;'>Please Select Gender</h3>";
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

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="username" id="form3Example1c" class="form-control" required />
                      <label class="form-label" for="form3Example1c">User Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="password" id="form3Example4c" class="form-control" required />
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="number" name="number" id="form3Example4cde" class="form-control" required />
                      <label class="form-label" for="form3Example4cde">Phone Number</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa-solid fa-transgender fas fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select class="form-select" name="gender" aria-label="Default select example">
                        <option disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa-solid fa-hand-pointer fas fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select class="form-select" name="role" aria-label="Default select example">
                        <option disabled selected>Select Your Roll</option>
                        <option value="1">Admin</option>
                        <option value="2">Editor</option>
                        <option value="3">Commentor</option>
                        <option value="4">Viewer</option>
                      </select>
                    </div>
                  </div>
                  <?php

                  // Current Time Pick
                  $dateTime = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
                  echo "<input hidden type='text' name='date' value='{$dateTime->format("d M Y h:i:s A")}'>";
                  ?>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>
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