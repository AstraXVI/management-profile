<?php
require "db.php";

$email = $_POST['email'];
$type = $_POST['type'];

$target_dir = "uploads/credentials/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$name = $_FILES["file"]["name"];

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "INSERT INTO `credential`(`email`, `pic`, `name`, `type`) VALUES ('$email','$target_file','$name','$type')";
    
    $con->query($q);

}
 

?>
