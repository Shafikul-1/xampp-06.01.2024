<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
    #error{
      display:none; 
      margin: 19px 30px; 
      color: white; background:red; 
      text-align: center;
      border-radius:4px;
    }
  </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="main_img/login.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
            Login
        </div>
        <p id="error"></p>
        <form class="p-3 mt-3" >
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="pass" id="pwd" placeholder="Password">
            </div>
            <button id="submitBtn" type="submit" name="submit" class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="<?php echo $mainUrl ?>/signup.php">Sign up</a>
        </div>
    </div>


    <script src="js/bootstrap.js"></script>
    <script src="js/login.js"></script>

</body>
</html>