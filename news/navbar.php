<?php include "config.php"; ?>
<h2 class="newsHeeding">  
  <?php 
  $settingQuery = "SELECT title FROM setting";
  $settingResult = mysqli_query($connection, $settingQuery) or die("Setting Query Failed");
  if(mysqli_num_rows($settingResult) > 0){
    while($settingRow = mysqli_fetch_assoc($settingResult)){
      echo $settingRow['title'];
    }
  }
  ?>
</h2>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $mainUrl ?>">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $mainUrl ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $mainUrl ?>admin">Admin</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="get" action="search.php">
        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<h3><?php //echo $_SERVER['REQUEST_URI']; ?></h3>