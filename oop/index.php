<pre>
<?php
include "database.php";
$obj = new database();

// $obj->insert('student', ['name' => 'test shafikul', 'roll' => 4354, 'city' => 'Bangladesh', 'gender' => 'Male', 'point' => 3423.2]);


// $obj->update('student', ['name' => 'oNLY mE', 'roll' => 435, 'city' => 'Bangladesh', 'gender' => 'Female', 'point' => 5.43400], "point='5'");


// $obj->delete('student',  "id='10'");
$obj->select('feedback', "*", null, null, null, 2);

$obj->pagination('feedback',null, null, 2);


echo "<br>";


echo "Result-->";
print_r($obj->getResult());
?>
</pre>