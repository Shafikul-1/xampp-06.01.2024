<?php 
include "config.php";
include "header.php";
session_unset();
session_destroy();

header("location: {$mainUrl}admin/");

?>