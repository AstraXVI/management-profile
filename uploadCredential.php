<?php
require "db.php";

$email = $_POST['email'];

$target_dir = "uploads/credentials/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "INSERT INTO `credential`(`email`, `pic`) VALUES ('$email','$target_file')";
    
    $con->query($q);

}
 

?>
