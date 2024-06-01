<!-- Created By CodingLab - www.codinglabweb.com -->
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
      <form action="insert_data.php" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name">
          </div>
          <div class="input-box">
            <span class="details">Date</span>
            <input type="date" placeholder="Enter your username" name="date">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" placeholder="Enter your number" name="number">
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
            <input type="file"  name="fileToUpload">
          </div>
        </div>
       
        <div class="button">
          <input type="submit" value="Insert Data Database">
        </div>
      </form>
    </div>
  </div>
</body>
</html>