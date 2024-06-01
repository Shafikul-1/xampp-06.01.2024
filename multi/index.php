<pre><?php
        if (isset($_POST["btnSubmit"])) {
            $errors = array();

            $extension = array("jpeg", "jpg", "png", "gif");

            $bytes = 1024;
            $allowedKB = 1000000;
            $totalBytes = $allowedKB * $bytes;

            if (isset($_FILES["files"]) == false) {
                echo "<b>Please, Select the files to upload!!!</b>";
                return;
            }

            $conn = mysqli_connect("localhost", "root", "", "dokan");

            foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
                $uploadThisFile = true;

                $file_name = $_FILES["files"]["name"][$key];
                $file_tmp = $_FILES["files"]["tmp_name"][$key];

                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                if (!in_array(strtolower($ext), $extension)) {
                    array_push($errors, "File type is invalid. Name:- " . $file_name);
                    $uploadThisFile = false;
                }

                if ($_FILES["files"]["size"][$key] > $totalBytes) {
                    array_push($errors, "File size must be less than 100KB. Name:- " . $file_name);
                    $uploadThisFile = false;
                }

                if (file_exists("Upload/" . $_FILES["files"]["name"][$key])) {
                    array_push($errors, "File is already exist. Name:- " . $file_name);
                    $uploadThisFile = false;
                }
                

                if ($uploadThisFile) {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . $ext;
                    move_uploaded_file($_FILES["files"]["tmp_name"][$key], "Upload/" . $newFileName);

                    print_r($newFileName);
                    $query = "INSERT INTO test(FilePath, FileName) VALUES('Upload','" . $newFileName . "')";

                    mysqli_query($conn, $query);
                }
            }

            mysqli_close($conn);

            $count = count($errors);

            if ($count != 0) {
                foreach ($errors as $error) {
                    echo $error . "<br/>";
                }
            }
        }




        ?></pre>
<h3>Uploaded Files:</h3>
<br />
<?php
$conn = mysqli_connect("localhost", "root", "", "dokan");

$query = "SELECT *FROM test";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $url = $row["FilePath"] . "/" . $row["FileName"];
?>
        <!-- <a href="<?php echo $url; ?>" style="display:flex">
            <image src="<?php echo $url; ?>" class="images" style="width:100px; "/>
        </a> -->
        <?php echo $url."<br>"; ?>
    <?php
    }
} else {
    ?>
    <p>There are no images uploaded to display.</p>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP upload multiple files</title>
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css" />
</head>

<body>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="text">Other rText:</label>
                <input type="text" name="text" id="text" />
            </div>
            <div>
                <label for="files">Select files to upload:</label>
                <input type="file" name="files[]" id="files" multiple="multiple" />
            </div>
            <div>
                <button name="btnSubmit" type="submit">Upload</button>
            </div>
        </form>
    </main>
</body>

</html>