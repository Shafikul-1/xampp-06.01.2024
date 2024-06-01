<?php 
include "database.php";
$obj = new database();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $gender = $_POST['gender'];
    $point = $_POST['point'];
    $city = $_POST['city'];

    $inputVal = ['name'=>$name, 'roll'=>$roll, 'gender'=>$gender, 'point'=>$point, 'city'=>$city];
    $obj->insert("student", $inputVal);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1px solid">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Gender</th>
            <th>point</th>
            <th>city</th>
        </tr>
        <?php  
        $obj->select("student", "*", null, null, null, 2);
        $val = $obj->getResult();
        foreach ($val as list("id"=>$id, "name"=> $name, "roll"=> $roll, "city"=>$city, "gender"=>$gender, "point"=> $point)) {
            echo " <tr>
            <td>$id</td>
            <td>$name</td>
            <td>$roll</td>
            <td>$gender</td>
            <td>$point</td>
            <td>$city</td>
        </tr>";
        }
        ?>
       
    </table>

    <?php 
    $obj->pagination("student", null, null, 2)
    ?>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="name" placeholder="Input Name">
        <input type="text" name="roll" placeholder="Input Roll">
        <input type="text" name="city" placeholder="Input city">
        <input type="text" name="gender" placeholder="Input Gender">
        <input type="text" name="point" placeholder="Input Point">
        <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>