<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/imageupload.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<?php 
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'efn') {
        echo '<h3 style="text-align: center; background-color: red; padding:10px 0; " class="errorMassage">Please Input The Folder Name</h3>';
    } else if($_GET['msg'] == 'fex') {
        echo '<h3 style="text-align: center; background-color: red; padding:10px 0; " class="errorMassage">Folder Name Already Exit</h3>';
    } else if($_GET['msg'] == 'fcf') {
        echo '<h3 style="text-align: center; background-color: red; padding:10px 0; " class="errorMassage">Folder Create Failed</h3>';
    }
    
}
?>

<div class="container-fluid">
       <div class="row d-flex justify-content-center align-items-center card_container">
            <div class="col-md-12 col-lg-6">
                <div class="card p-2">
                    <h1 class="text-center text-white">Upload Area</h1>
                    <form action="upload.php" method="post" enctype = "multipart/form-data">
                        <div class="form-group mt-3">
                            <label for="" class="form-label text-white">Folder Path Name /..</label>
                            <input type="text" name="path_name" id="title" placeholder="EX: folder name" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="form-label text-white">Image URL</label>
                            <input type="text" name="other_url" id="image" placeholder="ex: https://album:image.jpg" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="form-label text-white">Select Your File</label>
                            <input type="file" id="audio" name="files[]" class="form-control" multiple>
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="form-label text-white">Some Your File description</label>
                            <textarea name="description" id="desc" cols="30" rows="5 " class="form-control"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn w-100 p-3 text-black bg-info-subtle fs-4" id="btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

       </div>
    </div>
</body>
</html>