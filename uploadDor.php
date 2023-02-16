<?php
require "db.php";

$school = $_POST['school'];

$target_dir = "uploads/DOR/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "INSERT INTO `dor`(`school_name`, `dor_pics`) VALUES ('$school','$target_file')";
    
    $con->query($q);

}
 

?>